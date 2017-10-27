<?php
require_once $GLOBALS['THRIFT_ROOT'].'/packages/storm/ClusterAdmin.php';
require_once $GLOBALS['THRIFT_ROOT'].'/transport/TSocket.php';
require_once $GLOBALS['THRIFT_ROOT'].'/transport/TSocketPool.php';
require_once $GLOBALS['THRIFT_ROOT'].'/protocol/TBinaryProtocol.php';
require_once $GLOBALS['THRIFT_ROOT'].'/transport/TFramedTransport.php';
require_once $GLOBALS['THRIFT_ROOT'].'/transport/TBufferedTransport.php';
/**
 * 根据输入的用户名判断是否有权限
 * 
*/

function checkUser($users, $topology) {
    $socket = new TSocket("103.28.10.251", 8001);
    $socket->setSendTimeout(10000);
    $socket->setRecvTimeout(50000);
    $transport = new TFramedTransport($socket);
    $protocol = new TBinaryProtocol($transport);
    $transport->open();
    $client = new ClusterAdminClient($protocol);
    $topologyConf = $client->getTopologyConf($topology);
    $transport->close();
    $group_conf=$topologyConf->other_attr['group'];
    if (!in_array($group_conf, $users) && !in_array("all", $users)) {
                return false;
    }

    return true;
}
