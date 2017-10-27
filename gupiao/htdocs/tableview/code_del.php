<?php
/**
 * Created by PhpStorm.
 * User: 24445
 * Date: 2016-12-07
 * Time: 13:33
 */
session_start();
if(!isset($_SESSION['adminuser'])){
    $resualt['status'] = 1;
    $resualt['error'] ='请登录';
    echo json_encode($resualt);
    exit;
}
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

$code = $_POST['code'];
try {
    $db->delete('xl_hk_huizong', array('code' => $code));
    $db->delete('xl_hs_huizong', array('code' => $code));
    $db->delete('xl_hk_detail', array('code' => $code));
    $db->delete('xl_hs_detail', array('code' => $code));
    $db->delete('hk_stock_list',array('stock_code'=>$code));
    $db->delete('xl_hk_real_time_share_price ',array('stock_code'=>$code));
    $db->delete('sh_stock_list',array('stock_code'=>$code));
    $db->delete('xl_sh_real_time_share_price',array('stock_code'=>$code));
    $db->delete('sz_stock_list',array('stock_code'=>$code));
    $db->delete('xl_sh_real_time_share_price',array('stock_code'=>$code));
    $db->delete('xl_hk_caiwu',array('code'=>$code));
    $db->delete('xl_hk_value',array('code'=>$code));
    $db->delete('xl_hk_sunyi',array('code'=>$code));
    $db->delete('xl_hk_xianjin',array('code'=>$code));
    $db->delete('xl_hk_bank_fuzhai',array('code'=>$code));
    $db->delete('hk_bank_list',array('code'=>$code));
    $db->delete('history_hk_caiwu',array('code'=>$code));
    $db->delete('history_hk_lirun',array('code'=>$code));
    $db->delete('history_hk_fuzhai',array('code'=>$code));
    $db->delete('history_hk_xianjin',array('code'=>$code));

    $db->delete('xl_hs_bank_fuzhai',array('code'=>$code));
    $db->delete('xl_hs_bank_lirun',array('code'=>$code));
    $db->delete('xl_hs_bank_xianjin',array('code'=>$code));
    $db->delete('xl_hs_fuzhai',array('code'=>$code));
    $db->delete('xl_hs_lirun',array('code'=>$code));
    $db->delete('xl_hs_xianjin',array('code'=>$code));

    $black['code'] = $code;
    $db->insert('code_black_list',$black);

    $resualt['status'] = 0;
}catch(Exception $e){
    $resualt['status'] = 1;
    $resualt['error'] = $e->getMessage();
}
echo json_encode($resualt);
exit;

