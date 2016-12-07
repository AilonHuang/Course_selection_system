<?php
/**
 * Created by PhpStorm.
 * User: yilun
 * Date: 2016/10/26
 * Time: 15:01
 */
session_start();
if(isset($_COOKIE['username'])){
    $username = $_COOKIE['username'];
    echo '欢迎用户'.$username.'登录系统';
    echo '<br/><a href="logout.php">注销</a>';
}