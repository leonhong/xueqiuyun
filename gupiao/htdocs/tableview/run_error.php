<?php
header("content-type:text/html;charset=utf-8");
set_time_limit(18000000);
ini_set("display_errors", "On");
/**
 * 执行股票列表计算
 */
$basedir = dirname(__FILE__) . '/../../lib';
include  $basedir.'/config.php';
include  $basedir.'/functions.php';
include $basedir.'/mysqli.php';


/*配置数据库*/
$db_conf['host'] = 'localhost';
$db_conf['username'] = 'root';
$db_conf['password'] = '20160401';
$db_conf['database'] = 'stock';
$db_conf['prot'] = '3306';
/*实例DB*/
$db =  new DB($db_conf);
if($_GET['code']){
    $where = " where code ='{$_GET['code']}'";
}else{
    $where = '';
}
/*查询当前股票列表*/
try {
    $sql = "select * from xl_hk_value $where    ORDER  BY  code ASC";

    $list = $db->select($sql);
   // $list = array(array('code'=>'00025','shizhi'=>'630'));
    $go_type = $_GET['type']?$_GET['type']:'1';
    /**
     * 遍历当前所有股票
     */
    foreach($list as $k=>$v){

        //股票代码
        $code = $v['code'];
        //计算TTM(当前总市值/股东占盈利)
        $shizhi = $v['shizhi'];//当前总市值
        if(empty($shizhi) || $shizhi == '0'){
            continue;
        }

        //检查当前股票是否为银行股票
        $sql = "select * from hk_bank_list where code='$code'";
        $is_bank = $db->count($sql);
        if($is_bank>0){
            $sunyi_table_name = 'xl_hk_bank_sunyi';
            $fuzhai_table_name = 'xl_hk_bank_fuzhai';
            $ordername = 'baogaoriqi';
            $fuzhainame  = 'zongfuzhai';
        }else{
            $sunyi_table_name = 'xl_hk_sunyi';
            $fuzhai_table_name = 'xl_hk_fuzhai';
            $ordername = 'time';
            $fuzhainame  = 'zongfuzai';
        }

        echo $code."|".$sunyi_table_name;
        echo "</br>";
        echo $code."|".$fuzhai_table_name;
        echo "</br>";

            //=====计算股东占盈利开始=========//
            $sql = "select * from $sunyi_table_name where code='$code' order by $ordername desc";
            echo "|".$sql."</br>";
            $sunyi = $db->selectOne($sql);
            if (!$sunyi) {
                $err['code'] = $v['code'];
                $err['time'] = date("Y-m-d H:i:s");
                $db->insert('hk_error', $err);
                continue;
            }
            /*var_dump($sunyi);
            echo "</br>";*/
            $type = $sunyi['type'];   //当前报表类型

            $time = $sunyi[$ordername];   //当前报表时间

            if ($sunyi['bizhong'] == '港币') {
                $zhanying = $sunyi['gudongyingzhanyingli']; //当前股东占盈利
                $guxi = $sunyi['guxi'];
            } else {
                $sql = "select * from huilv where Fbizhong='{$sunyi['bizhong']}' and Tbizhong='港币'";
                $huilv = $db->selectOne($sql);
                if ($huilv) {
                    $zhanying = $sunyi['gudongyingzhanyingli'] * $huilv['value']; //当前股东占盈利
                    $guxi = $sunyi['guxi'] * $huilv['value'];
                } else {
                    $zhanying = $sunyi['gudongyingzhanyingli']; //当前股东占盈利
                    $guxi = $sunyi['guxi'];
                }

            }

            //获取上一年的年报
            $sql = "select * from $sunyi_table_name where code='$code' and type='年报' and $ordername < '$time' order by $ordername desc";
           echo "上一年".$sql;
        echo "</br>";
            $lastyearsunyi = $db->selectOne($sql);
            if ($lastyearsunyi['bizhong' == '港币']) {
                $lastyear = $lastyearsunyi['gudongyingzhanyingli'];
                $lastyear_guxi = $lastyearsunyi['guxi'];
            } else {
                $sql = "select * from huilv where Fbizhong='{$lastyearsunyi['bizhong']}' and Tbizhong='港币'";
                $huilv = $db->selectOne($sql);
                if ($huilv) {
                    $lastyear = $lastyearsunyi['gudongyingzhanyingli'] * $huilv['value'];
                    $lastyear_guxi = $lastyearsunyi['guxi'] * $huilv['value'];
                } else {
                    $lastyear = $lastyearsunyi['gudongyingzhanyingli'];
                    $lastyear_guxi = $lastyearsunyi['guxi'];
                }
            }
            /*var_dump($lastyearsunyi);
            echo "</br>";*/
            //获取上一年当前期的报表
            $sql = "select * from $sunyi_table_name where code='$code' and type='$type' and $ordername < '$time' order by $ordername desc";
            $lastsunyi = $db->selectOne($sql);
            /*var_dump($lastsunyi);
            echo "</br>";*/
            if ($lastsunyi['bizhong'] == '港币') {
                $last = $lastsunyi['gudongyingzhanyingli'];
                $last_guxi = $lastsunyi['guxi'];
            }else{
                $sql = "select * from huilv where Fbizhong='{$lastyearsunyi['bizhong']}' and Tbizhong='港币'";
                $huilv = $db->selectOne($sql);
                if ($huilv) {
                    $last = $lastsunyi['gudongyingzhanyingli']*$huilv['value'];
                    $last_guxi = $lastsunyi['guxi']*$huilv['value'];
                }else{
                    $last = $lastsunyi['gudongyingzhanyingli'];
                    $last_guxi = $lastsunyi['guxi'];
                }
            }
               //判断今年是否有财报
                /*if(empty($zhanying)){
                    $gudongzhanyingli = $lastyear*1000000;//股东占盈利
                }else{
                    $gudongzhanyingli = ($zhanying+($lastyear-$last))*1000000;//股东占盈利
                }
                if(empty($guxi)){
                    $dangqianguxi = $lastyear_guxi*1000000; //当前股息
                }else{
                    $dangqianguxi = ($guxi+($lastyear_guxi-$last_guxi))*1000000; //当前股息
                }*/
                 $gudongzhanyingli = ($zhanying+($lastyear-$last))*1000000;//股东占盈利
                 echo $guxi,"=".$lastyear_guxi."=".$last_guxi;
                 $dangqianguxi = ($guxi+($lastyear_guxi-$last_guxi))*1000000; //当前股息

                echo  $code."|市值：". $shizhi."|当前股息：".$dangqianguxi."|股东占盈利".$gudongzhanyingli;
                echo "</br>";

                $data['ttm'] = $gudongzhanyingli!='0'?$shizhi/$gudongzhanyingli:'0';
                $data['dyr'] = $shizhi!='0'?$dangqianguxi/$shizhi:'0';



                //=====计算股东占盈利结束=========//
                //获取当前股票负债信息
                $sql = "select * from $fuzhai_table_name where code='$code' order by $ordername desc";
		echo '111xxxxxxxxxxxxxxxx:'.$sql;
                $fuzhaixinxi = $db->selectOne($sql);
                if($fuzhaixinxi['bizhong']=='港币'){
                    $gudongquanyi = $fuzhaixinxi['gudongquanyi']*1000000;
                    $zongfuzhai = $fuzhaixinxi[$fuzhainame]*1000000;
                    $zongzichan = $fuzhaixinxi['zongzichan']*1000000;
                    $liudongzichan = $fuzhaixinxi['liudongzichan']*1000000;
                }else{
                    $sql = "select * from huilv where Fbizhong='{$fuzhaixinxi['bizhong']}' and Tbizhong='港币'";
                    $huilv = $db->selectOne($sql);
                    if(!$huilv){
                        $huilv['value'] = 1;
                    }
                    $gudongquanyi = $fuzhaixinxi['gudongquanyi']*1000000*$huilv['value'];
                    $zongfuzhai = $fuzhaixinxi[$fuzhainame]*1000000*$huilv['value'];
                    $zongzichan = $fuzhaixinxi['zongzichan']*1000000*$huilv['value'];
                    $liudongzichan = $fuzhaixinxi['liudongzichan']*1000000*$huilv['value'];
                }
		echo "gudongquanyi11111111111111".$gudongquanyi;
                //神奇公式单独计算一次股东权益（获取最近一年中的最大值）
                $sql = "select * from $fuzhai_table_name where code='$code' ORDER  BY $ordername desc";
                $dangqian = $db->selectOne($sql);
                $dangqianshijian = $dangqian[$ordername];
                $dangqiantype = $dangqian['type'];
                $sql = "select * from $fuzhai_table_name where code='$code' and  $ordername<='$dangqianshijian' and type='$dangqiantype' ORDER  BY $ordername desc";
                $qunian = $db->selectOne($sql);
                $qunianshijian = $qunian[$ordername];
		echo "eeeeeeeeeeee".$sql;
                $sql = "select * from $fuzhai_table_name where code='$code' and $ordername<='$dangqianshijian' and $ordername >= '$qunianshijian' ORDER  BY gudongquanyi desc";
		echo 'xxxxxxxxxxxxxxxx:'.$sql;
                $sqfuzhaixinxi = $db->selectOne($sql);
                if($sqfuzhaixinxi['bizhong']=='港币'){
                    $sqgudongquanyi = $sqfuzhaixinxi['gudongquanyi']*1000000;
                }else{
                    $sql = "select * from huilv where Fbizhong='{$sqfuzhaixinxi['bizhong']}' and Tbizhong='港币'";
                    $huilv = $db->selectOne($sql);
                    if(!$huilv){
                        $huilv['value'] = 1;
                    }
                    $sqgudongquanyi = $sqfuzhaixinxi['gudongquanyi']*1000000*$huilv['value'];
                }
		echo "gudongquanyi11111111111111_shenqi".$sqgudongquanyi;

                if($sqgudongquanyi != '0'){
                    $data['roe_sq'] = $gudongzhanyingli / $sqgudongquanyi;
                }else{
                    $data['roe_sq'] = '0';
                }

                if($gudongquanyi != '0') {
                    $data['pb'] = $shizhi / $gudongquanyi;
                    $data['roe'] = $gudongzhanyingli / $gudongquanyi;

                }else{
                    $data['pb'] = '0';
                    $data['roe'] = '0';
                }

		echo 'fin_putong='.$gudongquanyi." fin_shenqi=".$sqgudongquanyi."\n";
               if($zongzichan != '0'){
                   $data['debtratio'] = $zongfuzhai/$zongzichan;
               }else{
                   $data['debtratio'] = '0';
               }

                if($is_bank>0){
                    $data['jinjin'] = '0';
                }else{
                    $data['jinjin'] = $liudongzichan-$zongfuzhai;
                }

                $data['ctime'] = $time;
                $data['type'] = 1;
                $data['code'] = $v['code'];
                $data['shizhi'] = $shizhi;
                $data['bili'] = $data['jinjin']/$shizhi;
                echo json_encode($data);
                echo "</br>";

        //查询当前库中是否已经存在数据
        $sql = "select * from  xl_hk_huizong where code='{$v['code']}' and type = '1'";
        $huizong = $db->selectOne($sql);

        if($huizong){
               $id = $huizong['id'];
               $db->update('xl_hk_huizong',$data," id='$id'");
        }else{
                $db->insert('xl_hk_huizong',$data);
        }

    }
}catch(Exception $e){
    echo $e->getMessage();
}
