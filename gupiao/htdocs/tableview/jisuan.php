<?php
/**
 * Created by PhpStorm.
 * User: 24445
 * Date: 2016-12-06
 * Time: 15:59
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


$db_conf['host'] = 'localhost';
$db_conf['username'] = 'root';
$db_conf['password'] = '20160401';
$db_conf['database'] = 'stock';
$db_conf['prot'] = '3306';
/*配置数据库*/
/*实例DB*/
$db =  new DB($db_conf);
$str = '
    00001,
    00002,
    00003,
    00004,
    00005,
    00006,
    00008,
    00010,
    00011,
    00012,
    00014,
    00016,
    00017,
    00019,
    00020,
    00023,
    00027,
    00035,
    00038,
    00041,
    00042,
    00066,
    00069,
    00081,
    00083,
    00086,
    00101,
    00107,
    00109,
    00119,
    00123,
    00135,
    00136,
    00142,
    00144,
    00148,
    00151,
    00152,
    00163,
    00165,
    00168,
    00173,
    00175,
    00177,
    00178,
    00179,
    00187,
    00198,
    00200,
    00215,
    00220,
    00241,
    00242,
    00245,
    00256,
    00257,
    00267,
    00268,
    00270,
    00272,
    00285,
    00288,
    00291,
    00293,
    00297,
    00303,
    00308,
    00315,
    00316,
    00317,
    00321,
    00322,
    00323,
    00327,
    00330,
    00336,
    00337,
    00338,
    00341,
    00345,
    00347,
    00354,
    00358,
    00363,
    00368,
    00371,
    00378,
    00384,
    00386,
    00388,
    00390,
    00392,
    00400,
    00410,
    00412,
    00419,
    00425,
    00439,
    00440,
    00451,
    00460,
    00489,
    00493,
    00494,
    00506,
    00511,
    00522,
    00525,
    00546,
    00547,
    00548,
    00551,
    00552,
    00553,
    00563,
    00564,
    00568,
    00570,
    00576,
    00579,
    00586,
    00587,
    00588,
    00590,
    00598,
    00604,
    00606,
    00607,
    00636,
    00639,
    00656,
    00658,
    00659,
    00665,
    00669,
    00670,
    00680,
    00683,
    00688,
    00694,
    00696,
    00698,
    00699,
    00700,
    00709,
    00715,
    00719,
    00721,
    00728,
    00729,
    00732,
    00735,
    00737,
    00751,
    00753,
    00762,
    00763,
    00775,
    00777,
    00787,
    00806,
    00811,
    00813,
    00816,
    00817,
    00819,
    00836,
    00855,
    00857,
    00861,
    00867,
    00868,
    00874,
    00880,
    00881,
    00883,
    00884,
    00895,
    00902,
    00911,
    00914,
    00916,
    00921,
    00931,
    00933,
    00934,
    00939,
    00941,
    00958,
    00960,
    00966,
    00968,
    00976,
    00978,
    00981,
    00991,
    00992,
    00995,
    00996,
    00998,
    01030,
    01033,
    01038,
    01044,
    01052,
    01053,
    01055,
    01057,
    01060,
    01065,
    01066,
    01070,
    01071,
    01072,
    01083,
    01088,
    01093,
    01099,
    01108,
    01109,
    01112,
    01113,
    01114,
    01117,
    01128,
    01136,
    01138,
    01157,
    01169,
    01171,
    01177,
    01186,
    01188,
    01193,
    01199,
    01205,
    01208,
    01211,
    01230,
    01234,
    01236,
    01238,
    01253,
    01282,
    01288,
    01293,
    01299,
    01302,
    01308,
    01310,
    01313,
    01315,
    01316,
    01317,
    01333,
    01336,
    01339,
    01347,
    01359,
    01361,
    01363,
    01368,
    01378,
    01381,
    01382,
    01387,
    01398,
    01432,
    01448,
    01508,
    01513,
    01515,
    01528,
    01530,
    01618,
    01628,
    01636,
    01658,
    01661,
    01666,
    01668,
    01680,
    01685,
    01728,
    01766,
    01776,
    01777,
    01778,
    01788,
    01800,
    01811,
    01812,
    01813,
    01816,
    01819,
    01828,
    01829,
    01833,
    01880,
    01882,
    01883,
    01886,
    01888,
    01898,
    01918,
    01919,
    01928,
    01929,
    01958,
    01963,
    01966,
    01970,
    01972,
    01980,
    01988,
    01999,
    02005,
    02007,
    02009,
    02018,
    02020,
    02038,
    02039,
    02066,
    02128,
    02168,
    02186,
    02196,
    02199,
    02202,
    02208,
    02233,
    02238,
    02255,
    02282,
    02298,
    02313,
    02314,
    02318,
    02319,
    02326,
    02328,
    02329,
    02331,
    02333,
    02338,
    02356,
    02357,
    02369,
    02380,
    02382,
    02386,
    02388,
    02588,
    02600,
    02601,
    02607,
    02628,
    02666,
    02678,
    02688,
    02689,
    02727,
    02777,
    02866,
    02877,
    02880,
    02883,
    02888,
    02899,
    03301,
    03308,
    03311,
    03323,
    03328,
    03331,
    03333,
    03360,
    03377,
    03380,
    03382,
    03383,
    03393,
    03396,
    03606,
    03618,
    03698,
    03788,
    03799,
    03800,
    03808,
    03813,
    03818,
    03823,
    03836,
    03886,
    03888,
    03898,
    03899,
    03900,
    03908,
    03933,
    03958,
    03968,
    03969,
    03988,
    03993,
    03998,
    06030,
    06099,
    06178,
    06808,
    06818,
    06837,
    06863,
    06881,
    06886';
$shu_arr = explode(",",trim($str));
foreach($shu_arr as $k=>$v){
    $code = trim($v);
    $sql = "insert into xl_hk_ggt (`code`) VALUES ('$code')";
    /*
    echo $sql;
    exit;*/
    $db->query($sql);
}
