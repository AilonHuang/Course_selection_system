<?php

session_start();
if(!isset($_SESSION['username'])){
    header('Location:index.php');
    exit();
}else if($_SESSION['role'] != 'student'){
    header('Location:teacher.php');
    exit();
}
include 'db_conn.php';
include 'db_func.php';

//从会话中获取当前选课学生的学号
$StuNo = $_SESSION['username'];
$CouNo = $_POST['CouNo'];
$WillOrder = $_POST['WillOrder'];

$ModifyChosen_sql = "UPDATE StuCou SET WillOrder=WillOrder-1 WHERE StuNo='$StuNo' AND WillOrder >'$WillOrder'";
$ModifyChosenResult =db_query($ModifyChosen_sql);

$DeleteChosen_sql = "DELETE FROM StuCou WHERE StuNo='$StuNo' AND CouNo='$CouNo'";
$DeleteChosenResult = db_query($DeleteChosen_sql);

if($ModifyChosenResult&&$DeleteChosenResult){
    echo "<script>";
    echo 'alert("删除当前选课成功");';
    echo 'location.href="DropCourse.php";';
    echo "</script>";
}else{
    echo "<script>";
    echo 'alert("删除失败，请重新选择");';
    echo 'location.href="DropCourse.php";';
    echo "</script>";
}