<?php
/**
 * 获取报表信息
 *
 ************** 修改记录 *****************
 * 创建: by zhaoy1@neunn.com @2015-02-12
 */

$basedir = dirname(__FILE__) . '/../../../lib';
include $basedir . '/config.php';
include $basedir . '/functions.php';
include $basedir . '/mysqli.php';

$ret = array('error_code'=>SUCCESS, 'error_msg'=>'', 'info'=>array());

$req = $_POST;

/**
 * 执行股票列表计算
 */
$basedir = dirname(__FILE__) . '/../../lib';
include  $basedir.'/config.php';
include  $basedir.'/functions.php';
include $basedir.'/mysqli.php';


/*实例DB*/
$db =  new DB($db_conf);
$prepage = 50;
if($req['htype']=='ggt'){
	$where = 'where is_hk=1 ';
}else{
	$where = 'where 1=1 ';
}

if(!empty($req['key'])){
	$where .= " and (a.`code` like '%{$req['key']}%' or b.name like '%{$req['key']}%') ";
}

$name = $req['name'];
$sort = $req['sort'];
if($req['type']>-1){
	switch($req['type']){
		case '0':
			 $where .= " and a.ttm < 5 and a.ttm > 0 and a.dyr > 0.05 ";
			break;
		case '1':
			 $where .= " and a.ttm <10 and a.ttm > 0 and a.debtratio < 0.5 and a.debtratio >0 ";
			break;
		case '2':
			$where .= " and  a.ttm > 0 and a.shizhi < a.jinjin ";
			break;
		case '3':
			//$where .=" order by a.rank_all asc";
			if(empty($name) && empty($sort)) {
			   $name = 'rank_allsq';
			   $sort  = 'asc';
			}
			break;
		case '4':
			$where .= " and is_r15='1'";
			break;
		case '5':
			$where .= " and yg_r15='1'";
			break;
	}
}
$order = '';
if(!empty($name) && !empty($sort)){
	switch($name){
		case 'time':
			  $order = " order by b.update_time $sort";
			break;
		case 'gujia':
			 $order = " order by b.gujia $sort";
			break;
		case 'rank_all':
			$order = " order by a.rank_all $sort";
			break;
		default:
			$order = " order by a.$name  $sort";
			break;
	}

 }

//获取数据总数
$sql = "select a.*,b.* from xl_hk_huizong as a left join xl_hk_value as b on a.`code`=b.`code` $where $order";

$count = $db->count($sql);
//计算页数
$pagecount = ceil($count/$prepage);
$page = $req['page']?$req['page']:1;
$begin = ($page-1)*$prepage;
$sql = "select a.*,b.* from xl_hk_huizong as a left join xl_hk_value as b on a.`code`=b.`code` $where $order  limit $begin,$prepage";
/*echo $sql;
exit;*/
$list = $db->select($sql);
$ret['info'] = $list;
header('Content-type:text/json');
die(json_encode($ret));