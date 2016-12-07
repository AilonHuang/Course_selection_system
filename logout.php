<?php
/**
 * Created by PhpStorm.
 * User: yilun
 * Date: 2016/10/25
 * Time: 22:29
 */
session_start();
setcookie('username');
echo '注销成功';
//清空保存会话的数组
$_SESSION = array();

//毁灭会话
session_destroy();

echo '<script>';
echo 'alert("您已经安全退出，如有需要，请重新登录");';
echo 'location.href = "index.php";';
echo '</script>';
