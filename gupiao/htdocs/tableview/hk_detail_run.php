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

//获取股票列表
$sql = "select code from xl_hk_huizong";
$codelist = $db->select($sql);

//清空当前表
$sql = "truncate xl_hk_detail";
$db->query($sql);

if(!empty($codelist)){
    //获取开始时间
    $sql = "select max(end_time) as begin_time from xl_hk_caiwu";
    $begin_row = $db->selectOne($sql);
    $begin_year = date("Y",strtotime($begin_row['begin_time']));
    //获取结束时间
    $sql = "select min(end_time) as end_time from xl_hk_caiwu";
    $end_row = $db->selectOne($sql);
    $end_year = date("Y",strtotime($end_row['end_time']));

     echo $begin_year."---".$end_year."</br>";

     foreach($codelist as $crow){
          $code = $crow['code'];
         /*遍历年份*/
          for($year=$end_year;$year<=$begin_year;$year++){
              echo $code."=======".$year."</br>";
              $begin_time = $year."-01-01";
              $end_time = $year."-12-31";
              //查询损益表
              $sql = "select * from xl_hk_sunyi where code='$code' and time BETWEEN '$begin_time' and '$end_time' and type='年报'";
              echo $sql."</br>";
              $sunyi_row = $db->selectOne($sql);

              //查询财务表
              $sql = "select * from xl_hk_caiwu where code='$code' and time BETWEEN '$begin_time' and '$end_time' and type='年报'";
              echo $sql."</br>";
              $caiwu_row = $db->selectOne($sql);

              //查询股东权益
              $sql = "select max(gudongquanyi) as gudongquanyi from xl_hk_fuzhai where code='$code' and time BETWEEN '$begin_time' and '$end_time'";
              echo $sql."</br>";
              $gudong_row = $db->selectOne($sql);

              //查询负债表
              $sql = "select * from xl_hk_fuzhai where code='$code' and time BETWEEN '$begin_time' and '$end_time' and type='年报'";
              echo $sql."</br>";
              $fuzhai_row = $db->selectOne($sql);

              $data['yingyee'] = $sunyi_row['yingyee']; //营业额
              if($data['yingyee'] != '0') {
                  $data['xiaoshouchengben'] = $sunyi_row['xiaoshouchengben']/$data['yingyee'];  //销售成本
                  $data['maoli'] = $sunyi_row['maoli']/$data['yingyee'];  //毛利
                  $data['xiaoshoujifeixiaofeiyong'] = $sunyi_row['xiaoshoujifeixiaofeiyong']/$data['yingyee']; //销售及分销费用
                  $data['yibanjixingzhengfeiyong'] = $sunyi_row['yibanjixingzhengfeiyong']/$data['yingyee'];   //一般及行政费用
                  $data['lixifeiyong'] = $sunyi_row['lixifeiyong']/$data['yingyee'];  //利息费用
                  $data['jingyingyingli'] = $sunyi_row['jingyingyingli']/$data['yingyee']; //经营盈利
                  $data['gudongyingzhanyingli'] = $sunyi_row['gudongyingzhanyingli']/$data['yingyee']; //股东占盈利
                  $data['guxi'] = $sunyi_row['guxi']/$data['yingyee'];   //股息
                  $data['feijingchangxingshouyi'] = $caiwu_row['feijingchangxingshouyi']/$data['yingyee']; //非经常性收益
              }else{
                  $data['xiaoshouchengben'] = 0;  //销售成本
                  $data['maoli'] = 0;  //毛利
                  $data['xiaoshoujifeixiaofeiyong'] = 0; //销售及分销费用
                  $data['yibanjixingzhengfeiyong'] = 0;   //一般及行政费用
                  $data['lixifeiyong'] = 0;  //利息费用
                  $data['jingyingyingli'] = 0; //经营盈利
                  $data['gudongyingzhanyingli'] = 0; //股东占盈利
                  $data['guxi'] = 0;   //股息
                  $data['feijingchangxingshouyi'] = 0;  //非经常性收益
              }

              $data['zongzichan'] = $fuzhai_row['zongzichan']; //总资产
              if($data['zongzichan']!='0') {
                  $data['liudongzichan'] = $fuzhai_row['liudongzichan']/$data['zongzichan']; //流动资产
                  $data['xianjinjiyinhangjiecun'] = $fuzhai_row['xianjinjiyinhangjiecun']/$data['zongzichan']; //现金及银行结存
                  $data['yingshouzhangkuan'] = $fuzhai_row['yingshouzhangkuan']/$data['zongzichan'];  //应收账款
                  $data['cunhuo'] = $fuzhai_row['cunhuo']/$data['zongzichan'];   //存货
                  $data['feiliudongzichan'] = $fuzhai_row['feiliudongzichan']/$data['zongzichan'];  //非流动资产
                  $data['fushugongsiquanyi'] = $fuzhai_row['fushugongsiquanyi']/$data['zongzichan']; //附属公司权益
                  $data['wuyechangfangshebei'] = $fuzhai_row['wuyechangfangshebei']/$data['zongzichan']; //物业厂房设备
                  $data['lianyinggongsiquanyi'] = $fuzhai_row['lianyinggongsiquanyi']/$data['zongzichan']; //联营公司权益
                  $data['wuxingzichan'] = $fuzhai_row['wuxingzichan']/$data['zongzichan']; //无形资产
                  $data['qitatouzi'] = $fuzhai_row['qitatouzi']/$data['zongzichan']; //其它投资
                  $data['zongfuzai'] = $fuzhai_row['zongfuzai']/$data['zongzichan']; //总负债
                  $data['liudongfuzai'] = $fuzhai_row['liudongfuzai']/$data['zongzichan']; //流动负债
                  $data['yinhangdaikuan'] = $fuzhai_row['yinhangdaikuan']/$data['zongzichan']; //银行贷款
                  $data['yingfuzhangkuan'] = $fuzhai_row['yingfuzhangkuan']/$data['zongzichan']; //应付账款
                  $data['feiliudongfuzai'] = $fuzhai_row['feiliudongfuzai']/$data['zongzichan'];  //非流动负债
                  $data['feiliudongyinhangdaikuan'] = $fuzhai_row['feiliudongyinhangdaikuan']/$data['zongzichan']; //非流动银行贷款
                  $data['jingzichan'] = $fuzhai_row['jingzichan']/$data['zongzichan'];

                  $data['gudongquanyi'] = $gudong_row['gudongquanyi']/$data['zongzichan'];  //股东权益
                  $data['shaoshugudongquanyi'] = $fuzhai_row['shaoshugudongquanyi']/$data['zongzichan']; //少数股东权益
                  $data['chubei'] = $fuzhai_row['chubei']/$data['zongzichan']; //储备
              }else{
                  $data['liudongzichan'] = 0; //流动资产
                  $data['xianjinjiyinhangjiecun'] = 0; //现金及银行结存
                  $data['yingshouzhangkuan'] = 0;  //应收账款
                  $data['cunhuo'] = 0;   //存货
                  $data['feiliudongzichan'] = 0;  //非流动资产
                  $data['fushugongsiquanyi'] = 0; //附属公司权益
                  $data['wuyechangfangshebei'] = 0; //物业厂房设备
                  $data['lianyinggongsiquanyi'] = 0; //联营公司权益
                  $data['wuxingzichan'] = 0; //无形资产
                  $data['qitatouzi'] = 0; //其它投资
                  $data['zongfuzai'] = 0; //总负债
                  $data['liudongfuzai'] = 0; //流动负债
                  $data['yinhangdaikuan'] = 0; //银行贷款
                  $data['yingfuzhangkuan'] = 0; //应付账款
                  $data['feiliudongfuzai'] = 0;  //非流动负债
                  $data['feiliudongyinhangdaikuan'] = 0; //非流动银行贷款
                  $data['jingzichan'] = 0;

                  $data['gudongquanyi'] = 0;  //股东权益
                  $data['shaoshugudongquanyi'] =0; //少数股东权益
                  $data['chubei'] = 0; //储备
              }
              $sunyi = $db->select($sql);
              $data['code'] = $code;
              $data['year'] = $year;
              $data['ctime'] = date('Y-m-d H:i:s');

              $sql = "select * from xl_hk_detail where code='$code' and year='$year'";
              $row = $db->selectOne($sql);
              if(!$row){
                  $db->insert('xl_hk_detail', $data);
              }else{
                  $id = $row['id'];
                  $db->update('xl_hk_detail', $data," id='$id'");
              }
          }
     }
}else{
    echo "无数据！";
    exit;
}
