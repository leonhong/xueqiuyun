<?php
/**
 * 获取用户app列表
 */

$basedir = dirname(__FILE__) . '/../../../../lib';
include $basedir . '/config.php';
include $basedir . '/functions.php';
include $basedir . '/mysqli.php';

require_once $GLOBALS['THRIFT_ROOT'].'/packages/storm/ClusterAdmin.php';
require_once $GLOBALS['THRIFT_ROOT'].'/transport/TSocket.php';
require_once $GLOBALS['THRIFT_ROOT'].'/transport/TSocketPool.php';
require_once $GLOBALS['THRIFT_ROOT'].'/protocol/TBinaryProtocol.php';
require_once $GLOBALS['THRIFT_ROOT'].'/transport/TFramedTransport.php';
require_once $GLOBALS['THRIFT_ROOT'].'/transport/TBufferedTransport.php';


function getUserTopologies($users)
{
    
    $input_users=implode(',',$users);

    
    $t1 = microtime_float();
    echo 'start:  ';
    var_dump($t1);

    $url='http://storm01v.sys.zwt.qihoo.net:8080/storm/cluster/getUserTopo_test.php?input_users='.$input_users;
    $html = file_get_contents($url);
    $tmp1 = json_decode($html,true);
    $data=$tmp1['data'];


    $t1 = microtime_float();
    echo 'finish:  ';
    var_dump($t1);

   return $data;
}

$users=['xitong'];
$tmp=getUserTopologies($users);
