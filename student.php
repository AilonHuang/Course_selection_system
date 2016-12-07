<?php
session_start();



//如果没有登录就强制跳转到登录页面
if(!isset($_SESSION['username'])){
    header('Location:index.php');
    exit();
//如果已经登录但不是学生身份则强制跳转到教学秘书页面
}else if($_SESSION['role'] != 'student') {
    header('Location:teacher.php');
    exit();
}


echo '这是学生页面<br/>';
echo '学号：'.$_SESSION['username'].'<br/>';
echo '班级号码：'.$_SESSION['classno'].'<br/>';
include('foot.php');
?>