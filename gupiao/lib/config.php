<?php
date_default_timezone_set( 'Asia/Chongqing');

$GLOBALS['THRIFT_ROOT'] = dirname(__FILE__) . '/thrift';  

define('IS_CHECK_LOGIN', true); 

define('SUCCESS',              0);
define('FAIL',              3001);
define('INVALID_PARAMETER', 3002);
define('MISSING_PARAMETER', 3003);
define('UNLOGIN',           3004);
define('RECORD_USED',       3005);
define('UNKNOWN_ACTION',    3006);
define('WITHOUT_PERMISSION',3009);
define('NO_SUCH_RECORD',    3010);
define('SERVICE_TIMEOUT',   3011);
define('SERVICE_REFUSED',   3012);
define('NO_HDP_ACCOUNT',    3013);
define('TELL_MANAGER',      3014);
define('TABLE_MANAGER',      3032);//建表失败
define('TABLE_ZAI',      3033);//表已存在
define('Filed_ZAI',      3034);//字段重复
define('Filed_NUM',      3035);//字段为数字
define('Filed_IMPORT_DATA',      3036);//字段为数字

define('PHP_CLI_PATH',    '/usr/bin/php');

$s3_err_code = array(
    'RequestTimeTooSkewed' => 3015,
    'EntityTooLarge' => 3016,
    'InvalidArgument' => 3017,
    'MissingContentLength' => 3018,
    'BucketNameClash' => 3019,
    'BucketConfiguarationErr' => 3020,
    'Md5Missmatch' => 3021,
    'XmlInvalid' => 3022,
    'AccessDenied' => 3023,
    'AuthNotLogin' => 3024,
    'DateHeaderInvalid' => 3025,
    'ProductQuotaLimit' => 3026,
    'RangeHeaderInvalid' => 3027,
    'UserQuotaLimit' => 3028,
    'NoSuchKey' => 3029,
    'NoSuchBucket' => 3030,
    'InternalError' => 3031
);

define('HOST_NAME', isset($_SERVER) && isset($_SERVER["HTTP_HOST"]) ? $_SERVER["HTTP_HOST"] : 'nbds.sys.corp.qihoo.net');
define('HOST_URL',  'http://' . HOST_NAME);

define('LOGIN_PAGE', HOST_URL . '/apps/login.php');
define('INDEX_PAGE', HOST_URL . '/main.php');
define('LOGIN_NEW_PAGE', HOST_URL . '/index.html');

define('KFC_LOG_DIR', dirname(__FILE__) .'/../logs/');
define('KFC_LOG_DEBUG', 'DEBUG');
define('KFC_LOG_INFO', 'INFO');
define('KFC_LOG_SUCCESS', 'SUCCESS');
define('KFC_LOG_WARNING', 'WARNING');
define('KFC_LOG_ERROR', 'ERROR');
$db_config = array(
    'db_nbds'=>array(
        'host'=>'10.2.1.10', 'port'=>'3306', 'database'=>'db_nbds', 'username'=>'nbds_user', 'password'=>'neunbds',
    ),
    'db_hadoop'=>array(
        'host'=>'10.2.1.10', 'port'=>'3306', 'database'=>'hadoop_info', 'username'=>'hadoop_user', 'password'=>'neuhadoop',
    ),
    'db_privilege'=>array(
        'host'=>'10.2.1.10', 'port'=>'3306', 'database'=>'PrivilegeDB', 'username'=>'privilege_user', 'password'=>'neunprivilege',
    ),
	'db_kafka'=>array(
		'host'=>'10.2.1.10', 'port'=>'3306', 'database'=>'db_kafka', 'username'=>'storm_user', 'password'=>'neustorm',
	),
);

$yt_manager = array(
    'yt_alarm'=>'nebd',
    'yt_dev_mail'=>'nebd@neunn.com',
    'scribe_manager'=>'nebd@neunn.com',
);

$hdfs_manager = array(
    array('user'=>'zhaoyu','mail'=>'zhaoy1@neunn.com'),
  
);

$hdfs_black_list = array(
    'safe_lycc'=>array(
        '/home/cloud/dw/sync/safe2',
    ),
    'qss_zzbc2'=>array(
        '/home/maintable/sync/safe2',
    ),
);
//desensitization hadoop hive olap  privilege @ by shiky
$hive_clusters = array(
    'safe_lycc'=>array('host'=>'hdp10.b.neunn.com', 'port'=>'10003'),
);
//clusters_overview、data_clean 、desensitization、 hbase、 hdfs、 hive privilege @ by luany
$hdfs_clusters = array(
    'safe_lycc'=>array('host'=>'hdp10.b.neunn.com', 'port'=>'10005'),
);

$hdfs_path_pre = array(
);
//clusters_overview 、hbase 、hdfs、 hive、 mr @ by luany
$mr_clusters = array(
    'safe_lycc'=>array('host'=>'hdp10.b.neunn.com', 'port'=>'10002'),
);
// @ by luany
/* $kylin_clusters = array(
    'safe_lycc'=>array('host'=>'hdp1400.safe.lycc.qihoo.net', 'port'=>'10001'),
); */
//@ by liud
$hbase_clusters = array(
    'safe_lycc'=>array('host'=>'hdp10.b.neunn.com', 'port'=>'8092'),
);
$hbase_server = array(
    'safe_lycc'=>array('host'=>'10.2.8.7', 'port'=>'8585'),
);
//@ by liud
$mq_clusters = array(
    //'safe_lycc'=>array('host'=>'192.168.21.140', 'port'=>'9093'),
    'safe_lycc'=>array('host'=>'10.2.1.12', 'port'=>'9093'),
);
//@ by shiky
$strom_clusters = array(
    'safe_lycc'=>array('host'=>'10.2.1.12', 'port'=>'10017'),
);
//@ by shiky
$strom_app = array(
    'safe_lycc'=>array('host'=>'10.2.1.12', 'port'=>'10019'),
);
//@ by luany
$olap_clusters = array(
    'safe_lycc'=>array('host'=>'10.2.1.12', 'port'=>'12345'),
);
//@ by xuzq
$hot_news = array(
    'safe_lycc'=>array('host'=>'10.2.2.7', 'port'=>'8899'),
);
//@ by shiky
$desensitization_clusters = array(
    'safe_lycc'=>array('host'=>'10.2.1.12', 'port'=>'10011'),
);
//@ by xuzq
$hbase_spark_clusters = array(
  'safe_lycc'=>array('host'=>'10.2.2.7', 'port'=>'8091'),
);
//@ by xuzq 数据加载文件上传
$data_source = array(
  'safe_lycc'=>array('host'=>'10.2.2.7', 'port'=>'8094'),
);
$hbase_spark_dataview = array(
    'safe_lycc'=>array('host'=>'10.2.2.7', 'port'=>'8093'),
);
$hbase_spark_protrait = array(
    'safe_lycc'=>array('host'=>'10.2.2.7', 'port'=>'8090'),
);
//@ by xuzq  spark集群概况
$hbase_spark_monitor = array(
    'safe_lycc'=>array('host'=>'10.2.2.7', 'port'=>'8095'),
);
//@ by liud 数据同步 
$data_synchro_canalserver = array(
    'safe_lycc'=>array('host'=>'10.2.9.9', 'port'=>'15045'),
);

//@ by wums 数据收集flume 
$data_collection_flume = array(
    'safe_lycc'=>array('host'=>'10.2.1.12', 'port'=>'15046'),
);
$hbase_zk_addrs = array(

);

$storm_super_user = array(

);

$is_admin_user = array(
    'neunn',  
);

$storm_conf = array(

);

$storm_manager = array(
    'storm-mail' => 'zhaoy1@neunn.com'
);

$s3_config = array(
    'url' => '',
);
$s3_manager = array(
    array('user' => 'zhaoyu', 'mail' => 'zhaoy1@neunn.com'),
);

$hdfs_quota_manager = array(
    'zhaoyu',
);

$conf_op_type = array(
    '加入组' => 0,
    '退出组' => 1,
    '组内申请权限' => 2,
    '跨组申请权限' => 3,
    '添加用户' => 4,
    '删除用户' => 5,
    '删除用户角色' => 6,
    '添加用户角色' => 7,
    '添加角色' => 8,
    '删除角色' => 9,
    '添加角色权限' => 10,
    '删除角色权限' => 11,
);

$conf_to_op_type = array(
    '申请加入默认组',
    '申请退出默认组',
    '组内申请权限',
    '跨组申请权限',
    '添加用户',
    '删除用户',
    '删除用户角色',
    '添加用户角色',
    '添加角色',
    '删除角色',
    '添加角色权限',
    '删除角色权限',
);


$conf_req_status = array(
    0 => '待审批',
    1 => '已通过',
    2 => '未通过',
    3 => '已催办',
);

$conf_to_req_status = array(
   '待审批' => 0,
   '已通过' => 1,
   '未通过' => 2,
   '已催办' => 3,
);

/*
 * 集群概况 
 * 2016-01-14
 * lining
 */
$clusters_view = array(
    'numDeadNodes' => '死亡节点',
    'totalUsed' => '已使用',
    'PercentRemaining' => '剩余%',
    'NumberOfMissingBlocks' => '丢失块',
    'PercentUsed' => '使用%',
    'TotalFiles' => '文件总数',
    'PercentBlockPoolUsed' => '存储池使用%',
    'nodeUsage' => '节点使用比率(最小值/中间值/最大值/标准差)',
    'BlockPoolUsedSpace' => '存储池使用',
    'totalCapacity' => '总容量',
    'CacheCapacity' => '缓存容量',
    'numDecomNodes' => '丢失节点',
    'TotalBlocks' => '总块数',
    'numLiveNodes' => '正常节点数',
    'CacheUsed' => '缓存使用量',

    'containersPending' => '等待容器',
    'allocatedVirtualCores' => '已分配cpu',
    'lostNodes' => '失联节点',
    'totalNodes' => '总节点',
    'activeNodes' => '正常节点',
    'containersReserved' => '保留容器',
    'availableVirtualCores' => '可用cpu',
    'appsFailed' => '失败任务数',
    'availableMB' => '可用内存',
    'allocatedMB' => '已分配内存',
    'appsSubmitted' => '提交任务',
    'appsPending' => '等待任务',
    'unhealthyNodes' => '不健康节点',
    'decommissionedNodes' => '退役节点',
    'appsKilled' => '中止任务',
    'totalMB' => '总内存',
    'reservedMB' => '保留内存',
    'rebootedNodes' => '重启节点',
    'appsCompleted' => '完成任务',
    'reservedVirtualCores' => '保留cpu',
    'totalVirtualCores' => '总cpu',
    'appsRunning' => '正在运行的任务',
    'containersAllocated' => '已分配容器'

);

/*
 * 系统监控引入地址
 * lin@neunn.com by 2016-07-15
 * */
 $sys_control = "http://10.2.1.12/ganglia/";
 //http://61.161.249.26:8080/ganglia/  
 
