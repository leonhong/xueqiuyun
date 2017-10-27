<?php
ini_set("display_errors", "On");
/**
 * 创建hive表
 */
//$basedir = dirname(__FILE__) . '/../../lib';
$basedir = dirname(__FILE__) . '/../../lib';
include  $basedir.'/config.php';
include  $basedir.'/functions.php';
include $basedir.'/mysqli.php';
$ret = array('error_code'=>SUCCESS, 'error_msg'=>'');
if ($user = isLogin()) {
	$cluster_name = "safe_lycc";
	require_once $basedir.'/thrift/packages/tableview/DataView.php';
	require_once $basedir.'/thrift/transport/TSocket.php';
	require_once $basedir.'/thrift/transport/TSocketPool.php';
	require_once $basedir.'/thrift/protocol/TBinaryProtocol.php';
	require_once $basedir.'/thrift/transport/TFramedTransport.php';
	if (isset($hbase_spark_dataview[$cluster_name])) {

		$conf = $hbase_spark_dataview[$cluster_name];
		try {
			$start_time = microtime_float();
			$socket = new TSocket($conf['host'], $conf['port']);
			$socket->setSendTimeout(3000000);
			$socket->setRecvTimeout(3000000);
			$transport = new TFramedTransport($socket);
			$protocol = new TBinaryProtocol($transport);
			$client = new DataViewClient($protocol);


			$transport->open();
			//$data = $client->dv_getContent('/home/hdfs/sparkApp/dataView/Shenyang.json', 1000);
			$data = $client->dv_getContentBySQL($_POST['user_name'],$_POST['table_name'],$_POST['data_path'],$_POST['sql'],1000);
			$data = json_decode($data,true);
			$data['status'] = 0;
			$transport->close();
		} catch (Exception $e) {
			$data['status'] = 0;
			$data['error'] = $e->getMessage();
		}
	}
} else {
	$data['status']=1;
}

header('Content-type:text/json');
echo json_encode($data);
exit;
