<?php
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

/**
 * 计算rank排名
 */

//计算rank(ttm)A  排名

$sql = "select * from xl_hk_huizong where ttm>=0 ORDER BY  ttm asc";
$alist = $db->select($sql);
$i = 1;
foreach($alist as $ak=>$av){
    $ranka['rank_ttm'] = $i;
    $db->update("xl_hk_huizong",$ranka,"id='{$av['id']}'");
    $i++;
}

//计算rank(ttm)B 排名
$sql = "select * from xl_hk_huizong where ttm < 0 order by ttm desc";
$blist = $db->select($sql);
foreach($blist as $bk=>$bv){
    $rankb['rank_ttm'] = $i+1;
    $db->update("xl_hk_huizong",$rankb,"id='{$bv['id']}'");
    $i++;
}
//echo $i;

//计算rank(reo)排名
$sql = "select * from xl_hk_huizong  order by roe desc";
$rlist = $db->select($sql);
$i = 1;
foreach($rlist as $rk=>$rv){
    $rankroe['rank_roe'] = $i;
    $db->update("xl_hk_huizong",$rankroe,"id='{$rv['id']}'");
    $i++;
}

//计算ran(roe_sq)排名
$sql = "select * from xl_hk_huizong ORDER  by roe_sq desc";
$sqrlist = $db->select($sql);
$i = 1;
foreach($sqrlist as $sqrk=>$sqrv){
    $rankr['rank_roesq'] = $i;
    $db->update("xl_hk_huizong",$rankr,"id='{$sqrv['id']}'");
    $i++;
}

//联合排序
$sql = "select * from xl_hk_huizong";
$addlist = $db->select($sql);
foreach($addlist as $addk=>$addv){
    $rankadd['rank_all'] = $addv['rank_roe']+$addv['rank_ttm'];
    $rankadd['rank_allsq'] = $addv['rank_roesq']+$addv['rank_ttm'];
    $db->update("xl_hk_huizong",$rankadd,"id='{$addv['id']}'");
}


$sql = "select * from xl_hk_huizong ORDER  BY  rank_all asc";
$all_list = $db->select($sql);
$i = 1;
foreach($all_list as $allk=>$allv){
    $rankall['rank_all'] = $i;
    $db->update("xl_hk_huizong",$rankall,"id='{$allv['id']}'");
    $i++;
}

$sql = "select * from xl_hk_huizong ORDER  BY  rank_allsq asc";
$allsq_list = $db->select($sql);
$i = 1;
foreach($allsq_list as $allsqk=>$allsqv){
    $rankallsq['rank_allsq'] = $i;
    $db->update("xl_hk_huizong",$rankallsq,"id='{$allsqv['id']}'");
    $i++;
}



$sql = "update xl_hk_huizong set is_hk='1' where code in(select code from xl_hk_ggt)";
$db->query($sql);
