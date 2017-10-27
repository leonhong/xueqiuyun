<?php
/**
 * Created by PhpStorm.
 * User: 24445
 * Date: 2016-12-09
 * Time: 16:40
 */
session_start();
session_destroy();
header('location:/login.php');
