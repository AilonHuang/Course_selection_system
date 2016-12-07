<?php
/**
 * Created by PhpStorm.
 * User: yilun
 * Date: 2016/10/25
 * Time: 22:32
 */
session_start();
//如果没有登录就强制跳转到登录页面
if(!isset($_SESSION['username'])){
    header('Location:index.php');
    exit();
//如果已经登录但不是教师身份则强制跳转到学生页面
}else if($_SESSION['role'] != 'teacher'){
    header('Location:student.php');
    exit();
}

echo '这是教学秘书页面<br/>';
echo '教师编码：'.$_SESSION['username'].'<br/>';
echo '系部编码：'.$_SESSION['departno'].'<br/>';
include('foot.php');
