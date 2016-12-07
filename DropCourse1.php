<?php

session_start();
if(!isset($_SESSION['username'])){
    header('Location:index.php');
    exit();
}else if($_SESSION['role'] != 'student'){
    header('Location:index.php');
    exit();
}

//从会话中获取当前选课学生的学号
$StuNo = $_SESSION['username'];
$CouNo = $_GET['CouNo'];
$WillOrder= $_GET['WillOrder'];


include 'db_conn.php';
include 'db_func.php';

$ModifyChosen_sql = "UPDATE StuCou SET WillOrder=WillOrder-1 WHERE StuNo=$StuNo AND WillOrder>$WillOrder";
$ModifyChosenResult = db_query($ModifyChosen_sql);

$DeleteCourse_sql  ="DELETE FROM Course WHERE CouNo='$CouNo' AND CouNo='$CouNo'";
$DeleteCourseResult = db_query($DeleteCourse_sql);

if($DeleteCourseResult){
    echo '<script>';
    echo 'alert("删除当前选课成功");';
    echo 'location.href="DropCourse.php?p=0";';
    echo '</script>';
}else{
    echo '<script>';
    echo 'alert("删除失败，请重新删除");';
    echo 'location.href="DropCourse.php?p=0";';
    echo '</script>';
}

