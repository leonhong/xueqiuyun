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
/*if($_GET['code']){
    $where = " where code ='{$_GET['code']}'";
}else{
    $where = '';
}*/

//$where = " where stock_code='600007'";
$where = '';
$quanjudanwei = 1;
/*查询当前股票列表*/
try {
    $sql = "select * from xl_sz_real_time_share_price  $where    ORDER  BY  stock_code ASC";
    echo $sql;

    $list = $db->select($sql);
    // $list = array(array('code'=>'00025','shizhi'=>'630'));
    $go_type = $_GET['type']?$_GET['type']:'1';
    /**
     * 遍历当前所有股票
     */
    if(!$list){
        echo "数据错误";
        exit;
    }
    foreach($list as $k=>$v){

        //股票代码
        $code = $v['stock_code'];
        //计算TTM(当前总市值/股东占盈利)
        $shizhi = $v['total_market_value'];//当前总市值
        if(empty($shizhi) || $shizhi == '0'){
            continue;
        }

        //检查当前股票是否为银行股票
        /*$sql = "select * from hk_bank_list where code='$code'";
        $is_bank = $db->count($sql);*/
        $is_bank = 0;
        if($is_bank>0){
            $sunyi_table_name = 'xl_hk_bank_sunyi';
            $fuzhai_table_name = 'xl_hk_bank_fuzhai';
            $ordername = 'baogaoriqi';
            $fuzhainame  = 'fuzaiheji';
        }else{
            $sunyi_table_name = 'xl_hs_lirun';
            $fuzhai_table_name = 'xl_hs_fuzhai';
            $ordername = 'time';
            $fuzhainame  = 'fuzaiheji';
        }


        //=====计算股东占盈利开始=========//
        $sql = "select * from $sunyi_table_name where code='$code' order by $ordername desc";

        $sunyi = $db->selectOne($sql);
        echo $sql."|".$sunyi['guishuyumugongsisuoyouzhejingliru']."</br>";
        if (!$sunyi) {
            $err['code'] = $v['stock_code'];
            $err['time'] = date("Y-m-d H:i:s");
            $db->insert('hk_error', $err);
            continue;
        }
        /*var_dump($sunyi);
        echo "</br>";*/
        //$type = $sunyi['type'];   //当前报表类型
        $dangqiantime = $sunyi[$ordername];
        $lastyear = date('Y',strtotime($dangqiantime));
        $lasttime = ($lastyear-1)."-12-31";
        $lastdangqiantime = ($lastyear-1).'-'.date('m-d',strtotime($dangqiantime));

        $time = $sunyi[$ordername];   //当前报表时间

            $zhanying = $sunyi['guishuyumugongsisuoyouzhejingliru']; //当前股东占盈利
            $guxi = 0;

        //获取上一年的年报
        $sql = "select * from $sunyi_table_name where code='$code' and time='$lasttime' and $ordername < '$time' order by $ordername desc";



        $lastyearsunyi = $db->selectOne($sql);
        echo $sql."|".$lastyearsunyi['guishuyumugongsisuoyouzhejingliru']."</br>";
            $lastyear = $lastyearsunyi['guishuyumugongsisuoyouzhejingliru'];
            $lastyear_guxi = 0;
        /*var_dump($lastyearsunyi);
        echo "</br>";*/
        //获取上一年当前期的报表
        $sql = "select * from $sunyi_table_name where code='$code' and time='$lastdangqiantime' and $ordername < '$time' order by $ordername desc";
        $lastsunyi = $db->selectOne($sql);
        echo $sql."|".$lastsunyi['guishuyumugongsisuoyouzhejingliru']."</br>";
        /*var_dump($lastsunyi);
        echo "</br>";*/
            $last = $lastsunyi['guishuyumugongsisuoyouzhejingliru'];
            $last_guxi =0;
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
        $gudongzhanyingli = ($zhanying+($lastyear-$last))*$quanjudanwei;//股东占盈利
        $dangqianguxi = ($guxi+($lastyear_guxi-$last_guxi))*$quanjudanwei; //当前股息

        echo  $code."|市值：". $shizhi."|当前股息：".$dangqianguxi."|股东占盈利".$gudongzhanyingli;
        echo "</br>";

        $data['ttm'] = $gudongzhanyingli!='0'?$shizhi/$gudongzhanyingli:'0';
        $data['dyr'] = $shizhi!='0'?$dangqianguxi/$shizhi:'0';



        //=====计算股东占盈利结束=========//
        //获取当前股票负债信息
        $sql = "select * from $fuzhai_table_name where code='$code' order by $ordername desc";
      //  echo '111xxxxxxxxxxxxxxxx:'.$sql;
        $fuzhaixinxi = $db->selectOne($sql);
            $gudongquanyi = $fuzhaixinxi['guishuyumugongsigudongquanyiheji']*$quanjudanwei;
            $zongfuzhai = $fuzhaixinxi[$fuzhainame]*$quanjudanwei;
            $zongzichan = $fuzhaixinxi['zichanzhongji']*$quanjudanwei;
            $liudongzichan = $fuzhaixinxi['liudongzichanheji']*$quanjudanwei;
       // echo "gudongquanyi11111111111111".$gudongquanyi;
        //神奇公式单独计算一次股东权益（获取最近一年中的最大值）
        $sql = "select * from $fuzhai_table_name where code='$code' ORDER  BY $ordername desc";
        $dangqian = $db->selectOne($sql);
        $dangqianshijian = $dangqian[$ordername];
        /*$dangqiantype = $dangqian['type'];
        $sql = "select * from $fuzhai_table_name where code='$code' and  $ordername<='$dangqianshijian' and type='$dangqiantype' ORDER  BY $ordername desc";
        $qunian = $db->selectOne($sql);
        $qunianshijian = $qunian[$ordername];
echo "eeeeeeeeeeee".$sql;*/
        $qunianshijian = date("Y-01-01",strtotime($dangqianshijian));
        $sql = "select * from $fuzhai_table_name where code='$code' and $ordername<='$dangqianshijian' and $ordername >= '$qunianshijian' ORDER  BY guishuyumugongsigudongquanyiheji desc";
        $sqfuzhaixinxi = $db->selectOne($sql);
            $sqgudongquanyi = $sqfuzhaixinxi['guishuyumugongsigudongquanyiheji']*$quanjudanwei;

        if($sqgudongquanyi != '0'){
            $data['roe_sq'] = $gudongzhanyingli / $sqgudongquanyi;
        }else{
            $data['roe_sq'] = '0';
        }
        echo  $code."|市值：". $shizhi."|当前股息：".$dangqianguxi."|股东占盈利".$gudongzhanyingli."股东权益".$gudongquanyi."总资产".$zongzichan."流动资产".$liudongzichan;
        echo "</br>";
        if($gudongquanyi > '0') {
            $data['pb'] = $shizhi / $gudongquanyi;
            $data['roe'] = $gudongzhanyingli / $gudongquanyi;

        }else{
            $data['pb'] = '0';
            $data['roe'] = '0';
        }

        if($zongzichan > '0'){
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
        $data['code'] = $v['stock_code'];
        $data['shizhi'] = $shizhi;
        $data['bili'] = $data['jinjin']/$shizhi;
        echo json_encode($data);
        echo "</br>";

        //查询当前库中是否已经存在数据
        $sql = "select * from  xl_hs_huizong where code='{$code}' and type = '1'";
        $huizong = $db->selectOne($sql);

        if($huizong){
            $id = $huizong['id'];
            $db->update('xl_hs_huizong',$data," id='$id'");
        }else{
            $db->insert('xl_hs_huizong',$data);
        }

    }
}catch(Exception $e){
    echo $e->getMessage();
}
