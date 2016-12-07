<?php
/**
 * Created by PhpStorm.
 * User: yilun
 * Date: 2016/10/27
 * Time: 21:12
 */
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
$MaxNum = $_POST['MaxNum'];

//首先设定该生选当前课程的志愿次序
$Willorder = $MaxNum + 1;
$TakeCourse_sql = "INSERT INTO StuCou(StuNo,CouNo,WillOrder,State) VALUES ('$StuNo','$CouNo','$Willorder','报名')";
$TakeCourseResult =db_query($TakeCourse_sql);

if($TakeCourseResult){
    echo "<script>";
    echo 'alert("选课成功");';
    echo 'location.href="TakeCourse.php";';
    echo "</script>";
}else{
    echo "<script>";
    echo 'alert("选课失败，请重新选择");';
    echo 'location.href="TakeCourse.php";';
    echo "</script>";
}