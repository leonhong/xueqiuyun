<?php
/**
 * Created by PhpStorm.
 * User: 24445
 * Date: 2016-12-02
 * Time: 10:20
 */
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


$db_conf['host'] = 'localhost';
$db_conf['username'] = 'root';
$db_conf['password'] = '20160401';
$db_conf['database'] = 'stock';
$db_conf['prot'] = '3306';
/*配置数据库*/
/*实例DB*/
$db =  new DB($db_conf);

//获取股票列表
if(isset($_GET['code'])&&!empty($_GET['code'])){
    $sql = "select code from xl_hs_huizong where code='{$_GET['code']}'";
}else{
    $sql = "select code from xl_hs_huizong";
}

$sql = "select code from xl_hs_huizong where code='600004'";
$codelist = $db->select($sql);

//清空当前表
/*$sql = "truncate xl_hk_detail";
$db->query($sql);*/

//获取开始时间
$sql = "select max(`time`) as begin_time from xl_hs_lirun";
$begin_row = $db->selectOne($sql);
$begin_year = date("Y",strtotime($begin_row['begin_time']));
//获取结束时间
$sql = "select min(`time`) as end_time from xl_hs_lirun";
$end_row = $db->selectOne($sql);
$end_year = date("Y",strtotime($end_row['end_time']));

/*echo $begin_year."---".$end_year."</br>";
exit;*/
if($codelist){
    //遍历股票信息
    foreach($codelist as $crow) {
        $code = $crow['code'];
  //      echo "<<<<<<<<==========================开始============================>>>>>>>>" . '\r';
        echo $code . "\n";
        //检查当前股票是否为银行股票
        $sql = "select * from hs_bank_list where code='$code'";
        $is_bank = $db->count($sql);
        if($is_bank>0){
            $lirun_table_name = 'xl_hs_bank_lirun';
            $fuzhai_table_name = 'xl_hs_bank_fuzhai';
            $ordername = 'time';
            $fuzhainame  = 'fuzhaiheji';
            $lirunname = 'guishumugongsidejinglirun';
            $quanyi = 'gudongquanyiheji';
        }else{
            $lirun_table_name = 'xl_hs_lirun';
            $fuzhai_table_name = 'xl_hs_fuzhai';
            $ordername = 'time';
            $fuzhainame  = 'fuzaiheji';
            $lirunname = 'guishuyumugongsisuoyouzhejingliru';
            $quanyi = 'guishuyumugongsigudongquanyiheji';
        }

        /*遍历年份*/
        for ($year = $end_year; $year <= $begin_year; $year++) {
            $baoyue = '12';
            $baori = '31';
            //echo $bao_time . "|" . $baoyue . "|" . $baori . '\r';
            //当前年的年报时间
            if ($baoyue == '12') {
                $date = $year . '-' . $baoyue . '-' . $baori;
                $date_last = ($year - 1) . '-' . $baoyue . '-' . $baori;
            } else {
                $date = ($year + 1) . '-' . $baoyue . '-' . $baori;
                $date_last = $year . '-' . $baoyue . '-' . $baori;
            }
            //echo $date . "|" . $date_last . '\r';
            //history_hk_lirun  查询利润信息（股东应占利） 取年报
            //先查看当前年是否有信息
            $sql = "select * from $lirun_table_name where code='$code' and `time` like '%$year%'";

            $is_shuju = $db->select($sql);
            if (!$is_shuju) {
                echo "nodata:$code|||" . $year . $sql;
		echo "\n";
                continue;
            }
            $sql = "select * from $lirun_table_name where code='$code' and `time`='$date'";
            //echo  "</br>"."lirun:sql:".$sql."</br>";
            $lirun = $db->selectOne($sql);

            $jinglirun = $lirun[$lirunname];
            $jinglirun = str_replace(",", "", $jinglirun);
            $jinglirun = floatval($jinglirun);


            //股东权益 （取一年中最大的）
            $sql = "select max($quanyi) as gudongquanyi from $fuzhai_table_name where `code`='$code' and `time`>'$date_last' and `time`<='$date'";
            $fuzhai = $db->selectOne($sql);
            //echo $sql . '\n';

            $gudongquanyi = $fuzhai['gudongquanyi'];
            $gudongquanyi = str_replace(",", "", $gudongquanyi);
            $gudongquanyi = floatval($gudongquanyi);
            //echo $jinglirun . "/" . $gudongquanyi . '\r';

            if ($gudongquanyi != '0') {
                $data['roe'] = $jinglirun / $gudongquanyi;
            } else {
                $data['roe'] = 0;
            }
            if ($data['roe'] == '0' && $year != '2016') {
                echo "[roeerror:$code]";
		echo "\n";
            }
            //echo $year . "|" . $data['roe'] . "</br>";
            $data['code'] = $code;
            $data['year'] = $year;
            $data['ctime'] = date('Y-m-d H:i:s');
            //echo json_encode($data);
            try {
                $sql = "select * from xl_hs_detail where code='$code' and year='$year'";
                $row = $db->selectOne($sql);
                if (!$row) {
                    $db->insert('xl_hs_detail', $data);
                } else {
                    $id = $row['id'];
                    $db->update('xl_hs_detail', $data, " id='$id'");
                }


            } catch (Exception $e) {
                echo $e->getMessage() . "</br>";
            }
            //echo "<<<<<<<<==========================计算结束============================>>>>>>>>" . '\r';
        }

        //计算ROE连续10年大于15%

        $sql = "select * from xl_hs_detail where code='$code' and roe !='0' order by `year` asc";
        $list = $db->select($sql);
        $i = 0;
        $nowyear = "select count(*) as year_count from xl_hs_detail where code='$code' and roe !='0'";
        $yearcount = $db->selectOne($nowyear);

        if ($yearcount['year_count'] > 0 && $yearcount['year_count'] < 10) {
            $length = $yearcount['year_count'];
        } else {
            $length = 10;
        }
        //echo "length:$length----$code";
        $change = FALSE;
        foreach ($list as $lk => $lv) {
            //echo $lv['roe'] . "|||" . $i . "</br>";

            if ($lv['roe'] >= 0.15) {
                $i++;
            } else {
                $i = 0;
            }

            if ($i >= $length) {

                //$db->update("xl_hk_huizong",$r15," code='$code'");
                $change = TRUE;
                break;
            }

        }

        if ($change) {
            $r15['is_r15'] = 1;
            $db->update("xl_hs_huizong",$r15," code='$code'");
        } else {
            $sql = "update xl_hs_huizong set is_r15='0' where `code`='$code'";
            $db->query($sql);
        }


    }
}else{
    echo "当前无数据";
}


