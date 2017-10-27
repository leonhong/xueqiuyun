<?php
/**
 * 获取报表信息
 *
 ************** 修改记录 *****************
 * 创建=> by zhaoy1@neunn.com @2015-02-12
 */
$basedir = dirname(__FILE__) . '/../../../lib';
include $basedir . '/config.php';
include $basedir . '/functions.php';
include $basedir . '/mysqli.php';
/*实例DB*/

/*配置数据库*/
$db_conf['host'] = 'localhost';
$db_conf['username'] = 'root';
$db_conf['password'] = '20160401';
$db_conf['database'] = 'stock';
$db_conf['prot'] = '3306';
$db =  new DB($db_conf);
$ret = array('error_code'=>SUCCESS, 'error_msg'=>'', 'info'=>array());


if($_GET['htype']=='ggt'){
	$where = 'where is_hk=1 ';
}else{
	$where = 'where 1=1 ';
}
if(!empty($_GET['key'])){
	$where .= " and (a.`code` like '%{$_GET['key']}%' or b.name like '%{$_GET['key']}%') ";
}

if($_GET['type']>-1 && $_GET['type'] != "0"){
	switch($_GET['type']){
		case '1':
			 $where .= " and a.ttm < 5 and a.ttm > 0 and a.dyr > 0.05 ";
			break;
		case '2':
			 $where .= " and a.ttm <10 and a.ttm > 0 and a.debtratio < 0.5 and a.debtratio >0 ";
			break;
		case '3':
			$where .= " and  a.ttm > 0 and a.shizhi < a.jinjin ";
			break;
		case '4':
			//$where .=" order by a.rank_all asc";
			if(empty($name) && empty($sort)) {
			   $name = 'rank_allsq';
			   $sort  = 'asc';
			}
			break;
		case '5':
			$where .= " and is_r15='1'";
			break;
		case '6':
			$where .= " and yg_r15='1'";
			break;
	}
}

$sql = "select a.*,b.* from xl_hk_huizong as a left join xl_hk_value as b on a.`code`=b.`code` $where limit 0,20";
$list = $db->select($sql);
foreach($list as $k=>&$v) {
	$v['shizhi'] = sprintf('%.3f',$v['shizhi']/100000000);
    $v['ttm'] = sprintf('%.3f',$v['ttm']);
    $v['pb'] = sprintf('%.3f',$v['pb']);
    $v['roe_sq'] = sprintf('%.3f',$v['roe_sq']*100)."%";
	$v['roe'] = sprintf('%.3f',$v['roe']*100)."%";
	$v['dyr']= sprintf('%.3f',$v['dyr']*100)."%";
	$v['debtratio'] = sprintf('%.3f',$v['debtratio']*100)."%";
	$v['jinjin'] =  $v['jinjin']!='--'?sprintf('%.3f',$v['jinjin']/100000000):$v['jinjin'];
	$v['jinjin_s']= sprintf('%.3f',(($v['jinjin']/100000000)/($v['shizhi']/100000000))*100)."%"; 
}

$ret['info'] = $list;
header('Content-type=>text/json');
die(json_encode($ret));