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
$code_name = $_POST['code_name'];
$code_type = $_POST['code_type'];
$resualt['status'] = 0;
$resualt['error'] = '操作成功!';
switch($code_type){
    case 'gg':
         $table_name = 'hk_stock_list';
         $data['stock_code'] = $code;
         $data['stock_name'] = $code_name;
         $sql = "select * from $table_name where stock_code='$code'";
         $is_setcode = $db->selectOne($sql);
         if(!$is_setcode){
             $db->insert($table_name,$data);
             $db->insert('xl_hk_real_time_share_price',$data);
         }else{
             $resualt['status'] = 1;
             $resualt['error'] = '股票已存在!';
         }
        break;
    case 'ggt':
        $table_name = 'hk_stock_list';
        $data['stock_code'] = $code;
        $data['stock_name'] = $code_name;
        $sql = "select * from $table_name where stock_code='$code'";
        $is_setcode = $db->selectOne($sql);
        if(!$is_setcode){
            $db->insert($table_name,$data);
            $db->insert('xl_hk_real_time_share_price',$data);
            $gdata['code'] = $code;
            $db->insert('xl_hk_ggt',$gdata);
        }else{
            $resualt['status'] = 1;
            $resualt['error'] = '股票已存在!';
        }
        break;
    case 'hs':
        $table_name = 'sh_stock_list';
        $data['stock_code'] = $code;
        $data['stock_name'] = $code_name;
        $sql = "select * from $table_name where stock_code='$code'";
        $is_setcode = $db->selectOne($sql);
        if(!$is_setcode) {
            $db->insert('sh_stock_list', $data);
            $db->insert('xl_sh_real_time_share_price', $data);
        }else{
            $resualt['status'] = 1;
            $resualt['error'] = '股票已存在!';
        }

        break;
    case 'ss':
        $table_name = 'sz_stock_list';
        $data['stock_code'] = $code;
        $data['stock_name'] = $code_name;
        $sql = "select * from $table_name where stock_code='$code'";
        $is_setcode = $db->selectOne($sql);
        if(!$is_setcode) {
            $db->insert('sz_stock_list', $data);
            $db->insert('xl_sh_real_time_share_price', $data);
        }else{
            $resualt['status'] = 1;
            $resualt['error'] = '股票已存在!';
        }

        break;
}
$db->delete("code_black_list",array('code'=>$code));
echo json_encode($resualt);
exit;
