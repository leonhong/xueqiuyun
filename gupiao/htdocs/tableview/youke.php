<?php
/**
 * Created by PhpStorm.
 * User: 24445
 * Date: 2016-12-09
 * Time: 16:17
 */
session_start();
$_SESSION['youke'] = 'youke';
$_SESSION['login_time'] = time();
header("location:/hs_table.php");
