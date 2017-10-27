<?php
/**
 * Created by PhpStorm.
 * User: 24445
 * Date: 2016-12-07
 * Time: 15:12
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
/*配置数据库*/

$db_conf['host'] = 'localhost';
$db_conf['username'] = 'root';
$db_conf['password'] = '20160401';
$db_conf['database'] = 'stock';
$db_conf['prot'] = '3306';
$username = $_POST['username'];
$password = $_POST['password'];

/*实例DB*/
$db =  new DB($db_conf);
$sql = "select * from admin_user where username='$username'";
$admin = $db->selectOne($sql);

if(!$admin){
    $resualt['status'] =1;
    $resualt['error'] = '密码错误';
}else{
    if($admin['password'] != md5($password)){
        $resualt['status'] =1;
        $resualt['error'] = '密码错误';
    }else{
        session_start();
        $_SESSION['adminuser'] = $username;
        $_SESSION['login_time'] = time();
        $resualt['status'] = 0;
    }
}

echo json_encode($resualt);
exit;
