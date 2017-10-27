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

function getClusterInfo()
{
#     $socket = new TSocket($storm_conf['host'], $storm_conf['port']);
     $socket = new TSocket("admin01v.storm.zwt.qihoo.net", 8001);
     $socket->setSendTimeout(10000);
     $socket->setRecvTimeout(50000);
     $transport = new TFramedTransport($socket);
     $protocol = new TBinaryProtocol($transport);
     $transport->open();
     $client = new ClusterAdminClient($protocol);
     $ret=$client->getAllClusterState();
     $transport->close();

     ksort($ret, SORT_STRING);
     $clusters = array();
     $return_clusters = array();
     $total_nodes = 0;
     $total_slots = 0;
     foreach ($ret as $key => $val) {
    	 $total_nodes = $total_nodes + $val->total_nodes + $val->dead_nodes;
    	 $total_slots = $total_slots + $val->total_slots;
    	 $splits = explode("-", $key, 2); 
    	 krsort($splits);
    	 $rkey = join("-", $splits);
    	 $clusters[$rkey] = $val;
     }

    $tmp_cluster = array();
    $tmp_topology = array();
    foreach ($clusters as $key => $val) {
        $address = $val->address;
        if ($val->attr["waiwang"] == "yes" and !(strpos($address, "w-") === 0)) {
            $tmp_cluster['address'] = "w-" . $address;
        }
	$tmp_cluster['address']=$address.":8360";
        $tmp_cluster['version'] = $val->version;
        $tmp_cluster['name'] = $val->name;
        $tmp_cluster['report_time'] = $val->report_time;
        $tmp_cluster['alive_nodes'] = $val->total_nodes;
        $tmp_cluster['dead_nodes'] = $val->dead_nodes;
        $tmp_cluster['total_slots'] = $val->total_slots;
        $tmp_cluster['used_slots'] = $val->used_slots;
        $tmp_cluster['free_slots'] = $tmp_cluster['total_slots'] - $tmp_cluster['used_slots'];
        $attr = $val->attr;
        $OS=str_replace("CentOS release", "", $val->attr["os"]);
        $tmp_cluster['os']=str_replace("(Final)", "", $OS);
        $tmp_cluster['lvs'] = str_replace(":3772", "", $attr["drpc"]);
	$tmp_cluster['net'] = $val->attr["net_type"]." "."waiwang=" . $val->attr["waiwang"];
        $topology_list = $val->topology_list;
        
        $tmp_cluster['topology']=array();
        foreach($topology_list as $tpkey => $tpval){
            $uptimesecs=$tpval->attr['uptime'];
            $tmp_topology['uptime'] = ceil($uptimesecs / 3600) . "h";
	    $tmp_topology['uptime']=$tpval->name;
	    $tmp_topology['topology_address']= $address . ":8360/topology/" . $tpval->id;
	    $tmp_topology['slots'] = $tpval->workers;
	    $tmp_topology['update'] = $tpval->updatepercent;
	    array_push($tmp_cluster['topology'],$tmp_topology);
	} 

        array_push($return_clusters,$tmp_cluster); 
    }
    return $return_clusters;
}

$tmp1= getClusterInfo();
var_dump($tmp1);
