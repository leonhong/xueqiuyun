<?php
/**
 * 是否是hdfs管理员
 */
function isHdfsManager($user_name) {
    global $hdfs_manager;
    $ism = false;
    foreach ($hdfs_manager as $m) {
        if ($user_name == $m['user']) {
            $ism = true;
            break;
        }
    }
    return $ism;
}

function getHdfsManager() {
    global $hdfs_manager;
    $name_arr = array();
    foreach ($hdfs_manager as $m) {
        $name_arr[] = $m['user'];
    }
    return join(',', $name_arr);
}

function getHdfsManagerMail() {
    global $hdfs_manager;
    $name_arr = array();
    foreach ($hdfs_manager as $m) {
        $name_arr[] = $m['mail'];
    }
    return join(',', $name_arr);
}

function getS3ManagerMail() {
    global $s3_manager;
    $name_arr = array();
    foreach ($s3_manager as $m) {
        $name_arr[] = $m['mail'];
    }
    return join(',', $name_arr);
}
function parseHiveDbName($dbname) {
    return preg_replace("/[-]/", "_", $dbname);
}

function object_to_array($obj) 
{ 
    $_arr = is_object($obj) ? get_object_vars($obj) : $obj; 
    foreach ($_arr as $key => $val) 
    { 
        $val = is_object($val) ? object_to_array($val) : $val; 
        $arr[$key] = $val; 
    }
    return $arr; 
}

//二维数组去掉重复值
function array_unique_fb($array2D){
    foreach ($array2D as $v){
        $v = join(",",$v);  //降维,也可以用implode,将一维数组转换为用逗号连接的字符串
        $temp[] = $v;
    }
    $temp = array_unique($temp);    //去掉重复的字符串,也就是重复的一维数组
    foreach ($temp as $k => $v){
       $temp[$k] = explode(",",$v);   //再将拆开的数组重新组装
    }
    return $temp;
}

/**
 * 获取S3服务URL参数
 */
function genCanonicalizedResource($resource) {
    $arrPath = explode('?', $resource);
    $CanonicalizedResource = $arrPath[0];
    $i = 0;
    if(!empty($arrPath[1])) {
        $arrPara = explode('&', $arrPath[1]);
        rsort($arrPara);
        foreach($arrPara as $strPara) {
            if ($i == 0) {
                $CanonicalizedResource = $CanonicalizedResource . "?" . $strPara;
            } else {
                $CanonicalizedResource = $CanonicalizedResource . "&" . $strPara;
            }
            $i++;
        }
    }

    return $CanonicalizedResource;
}

/**
 * 计算S3服务签名信息
 */
function calculateSign($secret,$method,$canonicalizedHeaders, $canonicalizedResource) {
    $strSignData = $method . "\n" . $canonicalizedHeaders . $canonicalizedResource;
    $signStr = base64_encode(hash_hmac("sha1", $strSignData, $secret, true));

    return $signStr;
}

function sendAuditMail($conf) {
    global $yt_manager;
    $html = "<tr><th>目的</th><td><span>" . $conf['goal'] . "</span></td></tr>\n";
    for ($i = 0; $i < count($conf['data']); $i++) {
        $html .= "<tr><th>" . $conf['data'][$i]['name'] . "</th><td><span>" . $conf['data'][$i]['value'] . "</span></td></tr>\n";
    }
    if (isset($conf['audit_url'])) {
        $html .= "<tr><th>审批</th><td>";
        $html .= "<a href='" . $conf['audit_url'] . "'>点击链接进入NBDS审批</a>";
        $html .= "</td></tr>";
    }
    if (isset($conf['accept_url']) && isset($conf['reject_url'])) {
        $html .= "<tr><th>审批</th><td>";
        $html .= "<a href='" . $conf['accept_url'] . "'>通过</a><span>&nbsp; &nbsp; &nbsp;</span>";
        $html .= "<a href='" . $conf['reject_url'] . "'>拒绝</a>";
        $html .= "</td></tr>";
    }
    $tpl = file_get_contents($conf['tpl']);
    $html = str_replace('{content}', $html, $tpl);
    $mail = new MailUtil();
    $mail_info = array(
        'from'=>'nbds',
        //'from'=>$yt_manager['yt_alarm'],
        'to'=>$conf['to'],
        'cc' => isset($conf['cc']) ? $conf['cc'] : $yt_manager['yt_dev_mail'],
        'subject'=>'[NBDS审批提醒]' . $conf['goal'],
        #'subject'=>'[NBDS系统通知]' . $conf['goal'],
        'content'=>$html,
    ); 
    if ($mail->send($mail_info)) {
        dayLog('service', KFC_LOG_SUCCESS, 'sendmail', $conf['to'], $conf['cc']);
    } else {
        dayLog('service', KFC_LOG_ERROR, 'sendmail', $conf['to'], $conf['cc']);
    }
}

function sendAuditResultMail($conf) {
    global $yt_manager;
    $html = "<tr><th>目的</th><td><span>" . $conf['goal'] . "</span></td></tr>\n";
    for ($i = 0; $i < count($conf['data']); $i++) {
        $html .= "<tr><th>" . $conf['data'][$i]['name'] . "</th><td><span>" . $conf['data'][$i]['value'] . "</span></td></tr>\n";
    }
    $html .= "<tr><th>审批结果</th><td>";
    $html .= $conf['is_pass'] == 1 ? "<span style='color:green;'>通过</span>" : "<span style='color:red;'>不通过</span>";
    $html .= "</td></tr>";
    $tpl = file_get_contents($conf['tpl']);
    $html = str_replace('{content}', $html, $tpl);

    $mail = new MailUtil();
    $mail_info = array(
        'from'=>'nbds',
        //'from'=>$yt_manager['yt_alarm'],
        'to'=>$conf['to'],
        'cc' => isset($conf['cc']) ? $conf['cc'] : $yt_manager['yt_dev_mail'],
        'subject'=>'[NBDS系统通知]' . $conf['goal'],
        'content'=>$html,
    );
    if ($mail->send($mail_info)) {
        dayLog('service', KFC_LOG_SUCCESS, 'sendmail', $conf['to'], $conf['cc']);
    } else {
        dayLog('service', KFC_LOG_ERROR, 'sendmail', $conf['to'], $conf['cc']);
    }
}

function sendCommonMail($conf) {
    global $yt_manager;
    $html = "<tr><th>目的</th><td><span>" . $conf['goal'] . "</span></td></tr>\n";
    for ($i = 0; $i < count($conf['data']); $i++) {
        $html .= "<tr><th>" . $conf['data'][$i]['name'] . "</th><td><span>" . $conf['data'][$i]['value'] . "</span></td></tr>\n";
    }
    $tpl = file_get_contents($conf['tpl']);
    $html = str_replace('{content}', $html, $tpl);

    $mail = new MailUtil();
    $mail_info = array(
        'from'=>'g-nbds-dev',
        //'from'=>$yt_manager['yt_alarm'],
        'to'=>$conf['to'],
        'cc' => isset($conf['cc']) ? $conf['cc'] : $yt_manager['yt_dev_mail'],
        'subject'=>'[NBDS系统通知]' . $conf['goal'],
        'content'=>$html,
    );
    $response = $mail->send($mail_info);
    if ($response) {
        dayLog('service', KFC_LOG_SUCCESS, 'sendmail', $conf['to'], $conf['cc']);
    } else {
        dayLog('service', KFC_LOG_ERROR, 'sendmail', $conf['to'], $conf['cc']);
    }
    return $response;
}

function sendPushMail($conf) {
    global $yt_manager;
    $html = "<tr><th>目的</th><td><span>" . $conf['goal'] . "</span></td></tr>\n";
    for ($i = 0; $i < count($conf['data']); $i++) {
        $html .= "<tr><th>" . $conf['data'][$i]['name'] . "</th><td><span>" . $conf['data'][$i]['value'] . "</span></td></tr>\n";
    }
    $tpl = file_get_contents($conf['tpl']);
    $html = str_replace('{content}', $html, $tpl);

    $mail = new MailUtil();
    $mail_info = array(
        'from'=>'g-nbds-dev',
        //'from'=>$yt_manager['yt_alarm'],
        'to' => $conf['to'],
        'cc' => isset($conf['cc']) ? $conf['cc'] : $yt_manager['yt_dev_mail'],
        'subject'=>'[Hadoop权限系统通知]' . $conf['goal'],
        'content'=>$html,
    );
    $response = $mail->send($mail_info);
    if ($response) {
        dayLog('service', KFC_LOG_SUCCESS, 'sendmail', $conf['to'], $conf['cc']);
    } else {
        dayLog('service', KFC_LOG_ERROR, 'sendmail', $conf['to'], $conf['cc']);
    }
    return $response;
}
/*
 * 反馈、报警邮箱
 * lining 20160115
 * */
function sendWarningMail($conf) {
    global $yt_manager;
    $html = "<tr><th>目的</th><td><span>" . $conf['goal'] . "</span></td></tr>\n";
    for ($i = 0; $i < count($conf['data']); $i++) {
        $html .= "<tr><th>" . $conf['data'][$i]['name'] . "</th><td><span>" . $conf['data'][$i]['value'] . "</span></td></tr>\n";
    }
    $tpl = file_get_contents($conf['tpl']);
    $html = str_replace('{content}', $html, $tpl);
    $subject = '[NBDS系统通知]' . $conf['goal'];
    /*
    $mail = new MailUtil();
    $mail_info = array(
        'from'=>'g-nbds-dev',
        //'from'=>$yt_manager['yt_alarm'],
        'to'=>$conf['to'],
        'cc' => isset($conf['cc']) ? $conf['cc'] : $yt_manager['yt_dev_mail'],
        'subject'=>'[NBDS系统通知]' . $conf['goal'],
        'content'=>$html,
    );
    */
    //$response = $mail->send($mail_info);
    $response = postMail($yt_manager['yt_dev_mail'],$subject,$html);
    if ($response) {
        dayLog('service', KFC_LOG_SUCCESS, 'sendmail', $conf['to'], $conf['cc']);
    } else {
        dayLog('service', KFC_LOG_ERROR, 'sendmail', $conf['to'], $conf['cc']);
    }
    return $response;
}



function getPriComment($pri) {
    $pri = (int)$pri;
    $pri_arr = array();
    if ($pri & 1) {
        $pri_arr[] = 'ALTER';
    }
    if ($pri & 2) {
        $pri_arr[] = 'CREATE';
    }
    if ($pri & 4) {
        $pri_arr[] = 'DROP';
    }
    if ($pri & 8) {
        $pri_arr[] = 'SELECT';
    }
    if ($pri & 16) {
        $pri_arr[] = 'UPDATE';
    }
    if ($pri & 32) {
        $pri_arr[] = 'ALL';
    }
    return join(', ', $pri_arr);
}

/**
 * 从hdfs路径提取文件路径
 * 比如：
 * 原始路径是：hdfs://w-namenode.safe.zzbc.qihoo.net:9000/home/xitong/nbds/nbds_log/20150311/
 * 提取后路径：/home/xitong/nbds/nbds_log/20150310/
 */
function getHdfsRealPath($hdfs_path) {
    return preg_replace("/^hdfs:\/\/.+:\d+\//", "/", $hdfs_path);
}

/**
 * 判断是否是压缩文件
 */
function isCompress($file_name) {
    $suffix_arr = array('.gz', '.lzo', '.lzma', '.bz2', '.deflate');
    $is_compress = false;
    foreach ($suffix_arr as $suffix) {
        if (substr($file_name, strlen($suffix) * -1, strlen($suffix)) == $suffix) {
            $is_compress = true;
            break;
        }
    }
    return $is_compress;
}

/**
 * 发邮件
 */
function sendMail($to,$cc, $subject, $message) {
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=gb2312' . "\r\n";
    $headers .= 'From: ' . "\r\n";
    $headers .= 'CC: ' . $cc . "\r\n";
    mail($to, $subject, $message, $headers);
}

/**
 * 判断用户是否对某个集群某个账号有权限访问
 */
function isAllowAccess($user_name, $cluster_name, $account) {
    global $db_config;
    $db_hdp = new DB($db_config['db_hadoop']);
    $tmp_cluster_name = $db_hdp->escape($cluster_name);
    $tmp_account = $db_hdp->escape($account);
    $sql = "select count(user) as num from accounttousers where user='" . $user_name . "' and clustername='$tmp_cluster_name' and account='$tmp_account'";
    $data = $db_hdp->selectOne($sql);
    return true;
   /* if ($data['num'] > 0) {
        return true;
    } else {
        return false;
    }*/
}

/**
* 判断当前用户是否是Hadoop接口人
* 如果是，则返回负责的Hadoop账号信息；否则返回false
*/
function isHdpAdmin($user_name) {
    global $db_config;
    $db_hdp = new DB($db_config['db_hadoop']);
    $sql = "select account from accountinformation where accountinterface='$user_name'";
    $data = $db_hdp->select($sql);
    if (count($data) > 0) {
        return true;
    } else {
        return false;
    }
}

/**
 * 判断当前用户是否是管理员用户
 */
function isAdminUser($user_name) {
    global $is_admin_user;
    if (in_array($user_name, $is_admin_user)) {
	   return true;
    } else {
       return false;
    }
}

/**
* 判断当前用户是否是本组接口人
*/
function isGroupAdmin($user_name) {
    global $db_config;
    $db = new DB($db_config['db_privilege']);
    $sql = "select * from user where name='".$user_name."';";
    $row = $db->selectOne($sql);
    if( !empty($row) ) {
        $role_sql = "select * from role where id in (
                        select role_id from user_role where user_id = '".$row['id']."'
                        ) and owner_group='".$row['default_group']."';";
        $rs = $db->select($role_sql);
        foreach( $rs as $r ){
            if( $r['is_admin'] == 1 ){
                return true;
            }
        }
    }
    return false;
}

/**
 * 检查账号对目录是否有权限
 */
function isAllowAccessPath($cluster_name, $account, $path) {
    global $db_config;
    $is_allow = false;
    $db_hdp = new DB($db_config['db_hadoop']);
    $tmp_cluster_name = $db_hdp->escape($cluster_name);
    $tmp_account = $db_hdp->escape($account);
    $sql = "select path from permissionforaccount where clustername='" . $tmp_cluster_name . "' and account='" . $account . "' and optype='read'";
    $path_arr = array('/home/' . $account);
    $data = $db->select($sql);
    foreach ($data as $row) {
        if (!in_array($row['path'], $path_arr)) {
            $path_arr[] = $row['path'];
        }
    }
    foreach ($path_arr as $path_str) {
        if (substr($path_str, -1, 1) == '/') {
            $path_str = substr($path_str, 0, strlen($path_str) - 1);
        }
        if (stripos($path, $path_str, 0) === 0) {
            $is_allow = true;
            break;
        }
    }
    return $is_allow;
}

/**
 * 获取用户账号列表
 */
function getUserAccountArr($user_name, $cluster_name = '') {
    global $db_config;
    $account_arr = array();
    $db = new DB($db_config['db_hadoop']);
    $user_name = $db->escape($user_name);
    $sql = "select distinct(account) from accounttousers where user='" . $user_name . "'";
    if ($cluster_name != '') {
        $sql .= " AND clustername='$cluster_name'";
    }
    $data = $db->select($sql);
    foreach ($data as $row) {
        $account_arr[] = $row['account'];
    }
    return $account_arr;
}

/**
 * 管理员获取所有账号列表 
 */

function managerGetAccountArr( $cluster_name = '' ) {
    global $db_config;
    $account_arr = array();
    $db = new DB($db_config['db_hadoop']);
    $sql = "select distinct account from accounttousers";
    if ($cluster_name != '') {
        $sql .= " where clustername='$cluster_name' order by account;";

        $data = $db->select($sql);
        foreach ($data as $row) {
            $account_arr[] = $row['account'];
        }
    }
    return $account_arr;
}

/**
 * 获取用户账号列表
 */
function getUserAccountStr($user_name) {
    global $db_config;
    $account_arr = array();
    $db = new DB($db_config['db_hadoop']);
    $sql = "select distinct(account) from accounttousers where user='" . $user_name . "'";
    $data = $db->select($sql);
    foreach ($data as $row) {
        $account_arr[] = "'" . $row['account'] . "'";
    }
    return join(",", $account_arr);
}

/**
 * 获取用户组接口人有权限的账号列表
 */
function getAdminAccountStr($user_name) {
    global $db_config;
    $account_arr = array();
    $db = new DB($db_config['db_hadoop']);
    $sql = "select distinct(account) from accountinformation where accountinterface='" . $user_name . "'";
    $data = $db->select($sql);
    foreach ($data as $row) {
        $account_arr[] = "'" . $row['account'] . "'";
    }
    return join(",", $account_arr);
}

function getAdminAccountArr($user_name) {
    global $db_config;
    $account_arr = array();
    $db = new DB($db_config['db_hadoop']);
    $sql = "select distinct(account) from accountinformation where accountinterface='" . $user_name . "'";
    $data = $db->select($sql);
    foreach ($data as $row) {
        $account_arr[] = $row['account'];
    }
    return $account_arr;
}
/**
 * 数组转成字符串 
 */
function arr2SqlStr($arr) {
    $tmp_arr = array();
    foreach ($arr as $str) {
        $tmp_arr[] = "'" . $str . "'";
    }
    return join(",", $tmp_arr);
}

/**
 * 解析异常
 */
function setExceptionRet(&$ret, $msg) {
    $ret['error_code'] = FAIL;
    $ret['error_msg'] = $msg;
    $tmp = json_decode($msg, true);
    if (is_array($tmp)) {
        if (isset($tmp['error_code'])) {
            $ret['error_code'] = $tmp['error_code'];
        }
        if (isset($tmp['error_msg'])) {
            $ret['error_msg'] = $tmp['error_msg'];
        }
    } else {
        if (strpos($msg, 'timed out') > 0) {
            $ret['error_code'] = SERVICE_TIMEOUT;
            $ret['error_msg'] = '服务太忙，请稍后再试,有疑问请联系管理员';
        }
        if (strpos($msg, 'Connection refused [111]') > 0) {
            $ret['error_code'] = SERVICE_REFUSED;
            $ret['error_msg'] = '该集群暂时无法提供服务,有疑问请联系管理员';
        }
    }
    //定时导入应check输入的存在
    if( strpos($msg,'No files matching path') > 0 ) {
        $ret['error_code'] = FAILED;
        $ret['error_msg'] = '导入数据为空。';
    }
}

/**
 * 把hive关键字直接过滤掉
 */
function filterHiveSqlKeyword($sql) {
    return preg_replace("/[;]/", "", $sql);
}

/**
 * 获取字符串以某个分隔符分开后的最后一个字段
 */
function getLastField($str, $sep) {
    $tmp_arr = preg_split($sep, $str);
    $len = count($tmp_arr);
    if ($len > 0) {
        return $tmp_arr[$len - 1];
    } else {
        return null;
    }
}

/** 获取当前时间戳，精确到毫秒 */
function microtime_float() {
   list($usec, $sec) = explode(" ", microtime());
   return ((float)$usec + (float)$sec);
}

/**
 * hbase查询结果格式化
 */
function hbase_result_parse($result) {
    $res_arr = array();
    foreach ($result as $obj) {
        $row = array();
        $values = $obj->columns;
        foreach ( $values as $k=>$v ) {
            $row[$k] = $v->value;
        }
        $res_arr[] = $row;
    }
    return $res_arr;
}

/**
 * 检查用户登录态
 */
function checkLogin() {
    if (!IS_CHECK_LOGIN) {
        return array('user_name'=>'neunn', 'display_name'=>'neunn', 'user_mail'=>'');
    }
    session_start();
    session_write_close();
    if (isset($_SESSION['user_name']) && $_SESSION['user_name'] != NULL) {
        $info['user_name'] = $_SESSION['user_name'];
        $info['display_name'] = $_SESSION['display_name'];
        $info['user_mail'] = $_SESSION['user_mail'];
        $info['user_id'] = $_SESSION['user_id'];
        return $info;
    } else {
        $info = UrlLogin();
        session_start();
        if (isset($info['user'])) {
            $_SESSION['user_name'] = $info['user'];
            $_SESSION['display_name'] = $info['display'];
            $_SESSION['user_mail'] = $info['mail'];
            $_SESSION['user_id'] = $info['user_id'];
        }
        session_write_close();
    }
}

/**
 * 用户是否登录
 */
function isLogin() {
    $sinfo = false;
    if (!IS_CHECK_LOGIN) {
        $sinfo = array('user_name'=>'neunn', 'display_name'=>'neunn', 'user_mail'=>'');
    } else {
        session_start();
        session_write_close();
        if (isset($_SESSION['user_name']) && $_SESSION['user_name'] != NULL) {
            $sinfo = array(
                'user_name'=>$_SESSION['user_name'],
                'display_name'=>$_SESSION['display_name'],
                'user_mail'=>$_SESSION['user_mail'],
                'user_id' => $_SESSION['user_id']
            );
        }
    }
    return $sinfo;
}

/**
 * 用户是否登录
 */
function logout() {
    session_start();
    $_SESSION['user_name'] = NULL;
    unset($_SESSION['user_name']);
    session_destroy();
    session_write_close();
    $d_url = LOGIN_NEW_PAGE;
    header("Location:$d_url");
}

/**
 * 参数说明
 * D_URL:跳转地址
 * B_URL:备份的跳转地址
*/
function UrlLogin($D_URL='', $B_URL='') {
    //判断D_URL是否有效,无效换备份跳转地址B_URL
    $start_time = microtime_float();
//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL,$D_URL);
//     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// allow redirects 
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable 
//     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
//     curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  FALSE);
//     $contents = curl_exec($ch);
//     $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//     curl_close($ch);
//     if($http_code != 200) {
//         $D_URL = $B_URL;
//     }
    $req_time = microtime_float() ;
    $req_cost_time = $req_time - $start_time;

    //获取sid
    if(empty($_GET['sid'])) {
//         $S_URL = LOGIN_PAGE; 
//         $d_url = $D_URL.'?ref='.$S_URL;
        $S_URL = LOGIN_NEW_PAGE;
        $d_url = LOGIN_NEW_PAGE;
        header("Location:$d_url");
        $end_time = microtime_float();
        $cost_time = $end_time - $start_time;
        dayLog('cgi', KFC_LOG_ERROR, 'login', 'sid_error', $req_cost_time, $cost_time);
        exit;
    } else {
        $sid = trim($_GET['sid']);
        $url = $D_URL.'?sid='.$sid;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// allow redirects 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  FALSE);
        $result = curl_exec($ch);
        curl_close($ch);

        $info = array();
        if($result != 'None') {
            //解码
            $decodedArray = json_decode($result,true);  
            $info['mail'] = $decodedArray['mail'];
            $info['user'] = $decodedArray['user'];
            $info['display'] = $decodedArray['display'];
        }
        $end_time = microtime_float();
        $cost_time = $end_time - $start_time;
        dayLog('cgi', KFC_LOG_INFO, 'login', 0, $req_cost_time, $cost_time);
        return $info;
    }
}

/**
 * curl get data
 */
function curlGet($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}

/**
 * curl post data
 */
function curlPost($url, $post_data) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}

/**
 * 打日志，按天切割日志文件
 */
function dayLog($pre, $p1 = '0', $p2 = '0', $p3 = '0', $p4 = '0', $p5 = '0', $p6 = '0') {
    date_default_timezone_set( 'Asia/Chongqing');
    $t = time();
    $ymd = date('Ymd', $t);
    $filename = $pre . "-day.$ymd";
    return _log($filename, $t, $p1, $p2, $p3, $p4, $p5, $p6);
}

function _log($filename, $time, $p1 = '0', $p2 = '0', $p3 = '0', $p4 = '0', $p5 = '0', $p6 = '0') {
    date_default_timezone_set( 'Asia/Chongqing');
    $time = date('Y-m-d H:i:s', $time);
    $filePath = KFC_LOG_DIR . $filename;
    if (!file_exists($filePath)) {
        $fp = @fopen($filePath, 'a+');
        flock($fp, LOCK_EX);    
        fwrite($fp, "");
        flock($fp, LOCK_UN);
        fclose($fp);
        chmod($filePath, 0777);
    }
    if (!$fp = @fopen($filePath, 'a+')) {
        return FALSE;
    }

    if (isset($_SERVER) && isset($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
        $username = ($user = isLogin()) ? $user['user_name'] : 'unknown-user';
        $page = $_SERVER['PHP_SELF'] . (isset($_SERVER["QUERY_STRING"]) && $_SERVER["QUERY_STRING"] != '' ? '?' . $_SERVER["QUERY_STRING"] : '');
    } else {
        $ip = 'local';
        $username = 'console';
        $page = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : 'unknown';
    }
    flock($fp, LOCK_EX);
    $p4 = serialize($p4);
    fwrite($fp, "$time\t$ip\t$username\t$page\t$p1\t$p2\t$p3\t$p4\t$p5\t$p6\n");
    flock($fp, LOCK_UN);
    fclose($fp);
    return TRUE;
}

/** 字节数转换成其它单位的
 * lining  
 * 2015-12-25
 * */
function size2mb($size,$digits=2){ //digits，要保留几位小数
    if ($size == 0){
        return '0B';
    }else {
        $unit= array('','K','M','G','T','P');//单位数组，是必须1024进制依次的哦。
        $base= 1024;//对数的基数
        $i   = @floor(log($size,$base));//字节数对1024取对数，值向下取整。
        $res = $size/pow($base,$i);
        // $res = $ress/3;
        return round($res,$digits).' '.$unit[$i] . 'B';
        // return round($size/pow($base,$i),$digits).' '.$unit[$i] . 'B';
    }
   
}


/*
 * lining 2016-01-04
 * 发送邮件 插件
 * */
function postMail($to,$subject = '',$body = ''){
    require 'sendMail/class.phpmailer.php';
    ini_set("magic_quotes_runtime",0);
    try {
        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        $mail->CharSet='UTF-8'; //设置邮件的字符编码，这很重要，不然中文乱码
        $mail->SMTPAuth = true; //开启认证
        $mail->Port = 25;
        $mail->Host = "smtp.126.com";
        $mail->Username = "zhyu89730105@126.com";
        $mail->Password = "89730105";
        //$mail->IsSendmail(); //如果没有sendmail组件就注释掉，否则出现“Could not execute: /var/qmail/bin/sendmail ”的错误提示
        $mail->AddReplyTo("zhyu89730105@126.com","mckee");//回复地址
        $mail->From = "zhyu89730105@126.com";
        $mail->FromName = "nbds@neunn.com";
        //$to = $to;
        $mail->AddAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; //当邮件不支持html时备用显示，可以省略
        $mail->WordWrap = 80; // 设置每行字符串的长度
        //$mail->AddAttachment("f:/test.png"); //可以添加附件
        $mail->IsHTML(true);
        $mail->Send();
        //echo '邮件已发送';
        dayLog('service', KFC_LOG_SUCCESS, '邮件已发送');
    } catch (phpmailerException $e) {
        //echo "邮件发送失败：".$e->errorMessage();
        dayLog('service', KFC_LOG_SUCCESS, '邮件发送失败', $e->errorMessage());
    }

}
/* 集群概况
 * 获取json值
 * json值转为数组
 * lining 2016-01-13
 * */
function analyJson($json_str) {
    $json_str = str_replace('＼＼', '', $json_str);
    $out_arr = array();
    preg_match('/{.*}/', $json_str, $out_arr);
    //print_r($out_arr);
    if (!empty($out_arr)) {
        $result = json_decode($out_arr[0], TRUE);
         
    } else {
        return FALSE;
    }

    return $result;
}
/* 集群概况
 * 节点信息
 * 比较键名
 * lining 2016-01-13
 * */
function myfunction($key1,$key2)
{
    if ($key1===$key2)
    {
        	
        return 0;
    }
    return ($key1>$key2)?1:-1;
}


/*
 * 数字三位加，
 * lining 2016-01-14
 * */
 function strcut($str){
    $i = strlen($str) % 3;
    if($i) $str = str_repeat('-', 3 - $i).$str;
    return ltrim(implode(',', str_split($str,3)),'-');
 }
 
 
 /*
  * 删除字符串中所有空格
  * lining 2016-01-14
  * */
 function trimall($str)//删除空格
 {
     $qian=array(" ","　","\t","\n","\r");$hou=array("","","","","");
     return str_replace($qian,$hou,$str);
 }
 
 /*
  * json串 decode后对象转数组
  * lining 2016-2-29
  * */
 function object_array($array){
     if(is_object($array)){
         $array = (array)$array;
     }
     if(is_array($array)){
         foreach($array as $key=>$value){
             $array[$key] = object_array($value);
         }
     }
     return $array;
 }
 /*
  * 用时,毫秒转时间
  * lining 2016-10-20
  * */
 function durationToTime($ms){
     $his = $ms/1000;
     if($his < 60){
         $his = round($his,2)."s";
     }
     if($his>=60 && $his<3600){
         $his = round($his/60,2)."min";
     }
     if ($his>=3600){
         $his = round($his/3600,2)."h";
     }
     return $his;
 }
 
 /**
  * php正则验证
  * 只允许 数字、字母、下划线
  * 最短1位、最长40位
  */
 function nameValidate($str) {
     if (preg_match('/^[_0-9a-z]{1,40}$/i',$str)){
         return true;
     }else {
         return false;
     }
 }
 
 /*
  * Web Uploader
  * 创建: by lining @2016-8-11
  * 调取:
  * $uploadDir = "/home/".$account."/hive/warehouse/".$database.".db/".$table_name; 上传路径
  * $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
  * $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 1;
  * $buff = fread($in, 524288),$readnum=524288;读取字节数
  * 来源:apps/hdfs/fileupload.php
  * */
 function webUploader($uploadDir,$chunk,$chunks,$readnum){

     $targetDir = 'upload_tmp';
     $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
     
     //$uploadDir = "/home/".$account."/hive/warehouse/".$database.".db/".$table_name;
      
     // Chunking might be enabled
     $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
     $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 1;
      
     $cleanupTargetDir = true; // Remove old files
     $maxFileAge = 5 * 3600; // Temp file age in seconds
      
     // Create target dir
     if (!file_exists($targetDir)) {
         @mkdir($targetDir);
     }
     
     
     // Remove old temp files
     if ($cleanupTargetDir) {
         if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
             $ret['error_code'] = Filed_IMPORT_DATA;
             die(json_encode($ret));
         }
     
         while (($file = readdir($dir)) !== false) {
             $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;
     
             // If temp file is current file proceed to the next
             if ($tmpfilePath == "{$filePath}_{$chunk}.part" || $tmpfilePath == "{$filePath}_{$chunk}.parttmp") {
                 continue;
             }
     
             // Remove temp file if it is older than the max age and is not the current file
             if (preg_match('/\.(part|parttmp)$/', $file) && (@filemtime($tmpfilePath) < time() - $maxFileAge)) {
                 @unlink($tmpfilePath);
             }
         }
         closedir($dir);
     }
     
     // Open temp file
     if (!$out = @fopen("{$filePath}_{$chunk}.parttmp", "wb")) {
         $ret['error_code'] = Filed_IMPORT_DATA;
         die(json_encode($ret));
     }
     
     if (!empty($_FILES)) {
         if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
             $ret['error_code'] = Filed_IMPORT_DATA;
             die(json_encode($ret));
         }
     
         // Read binary input stream and append it to temp file
         if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
             $ret['error_code'] = Filed_IMPORT_DATA;
             die(json_encode($ret));
         }
     } else {
         if (!$in = @fopen("php://input", "rb")) {
             $ret['error_code'] = Filed_IMPORT_DATA;
             die(json_encode($ret));
         }
     }
     
     while ($buff = fread($in, $readnum)) {
         fwrite($out, $buff);
     }
     
     @fclose($out);
     @fclose($in);
     rename("{$filePath}_{$chunk}.parttmp", "{$filePath}_{$chunk}.part");
     
     $index = 0;
     $done = true;
     for( $index = 0; $index < $chunks; $index++ ) {
         if ( !file_exists("{$filePath}_{$index}.part") ) {
             $done = false;
             break;
         }
     }
     
     return $done;
 }
 
