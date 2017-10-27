<?php
ini_set("display_errors", "On");
/**
 * 鍒涘缓hive琛�
 */
//$basedir = dirname(__FILE__) . '/../../lib';
include  '../../lib/config.php';
include  '../../lib/functions.php';
include '../../lib//mysqli.php';
$ret = array('error_code'=>SUCCESS, 'error_msg'=>'');
if ($user = isLogin()) {
    $cluster_name = "safe_lycc";
    require_once '../../lib/thrift/packages/tableview/DataView.php';
    require_once '../../lib/thrift/transport/TSocket.php';
    require_once '../../lib/thrift/transport/TSocketPool.php';
    require_once '../../lib/thrift/protocol/TBinaryProtocol.php';
    require_once '../../lib/thrift/transport/TFramedTransport.php';
    if (isset($hbase_spark_dataview[$cluster_name])) {

        $conf = $hbase_spark_dataview[$cluster_name];
        try {

            $type = $_POST['show_type'];
            if($type=='pie'){
                $canarr = array(
                    'classify' => $_POST['fenlei'],
                    'xname' => $_POST['xname']
                );
            }
            else if ($type=='polar'){
            	$canarr = json_decode($_POST['clum'],true);
            }
            else if($type=='spending'){
            	$canarr = array(
            		'classify'=>$_POST['fenlei'],
            		'clum'=>$_POST['clum']	
            	);
            }
            else if($type=='wordcloud')
            {
            	$canarr = array('classify'=>$_POST['fenlei']);
            }
            else {
                $canarr = array(
                    'classify' => $_POST['fenlei'],
                    'xname' => $_POST['xname'],
                    'yname' => $_POST['yname']
                );
            }
            $start_time = microtime_float();
            $socket = new TSocket($conf['host'], $conf['port']);
            $socket->setSendTimeout(3000000);
            $socket->setRecvTimeout(3000000);
            $transport = new TFramedTransport($socket);
            $protocol = new TBinaryProtocol($transport);
            $client = new DataViewClient($protocol);
            $transport->open();
            $data = $client->dv_processDataNew($_POST['shuju'],$type, json_encode($canarr));
            $transport->close();
            header('Content-type:text/json');
            echo $data;
            exit;
        } catch (Exception $e) {
            header('Content-type:text/json');
            $res['error'] = $e->getMessage();
            echo json_encode($res);
            exit;
        }
    }
} else {
    $ret['error_code'] = UNLOGIN;
}

header('Content-type:text/json');
die(json_encode($ret));
