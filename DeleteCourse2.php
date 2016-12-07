<?php
/**
 * Created by PhpStorm.
 * User: yilun
 * Date: 2016/10/27
 * Time: 19:30
 */
session_start();
if(!isset($_SESSION['username'])){
    header('Location:index.php');
    exit();
}else if($_SESSION['role'] != 'teacher'){
    header('Location:index.php');
    exit();
}

//从会话中获取系部编号
$DepartNo = $_SESSION['departno'];
$CouNo = $_GET['CouNo'];

include 'db_conn.php';
include 'db_func.php';


    $DeleteCourse_sql  ="DELETE FROM Course WHERE CouNo='$CouNo' AND DepartNo='$DepartNo'";
    $DeleteCourseResult = db_query($DeleteCourse_sql);

    if($DeleteCourseResult){
        //删除原来的图片
        $oldpic = './uploadpics/'.$CouNo.'.jpg';
        unlink($oldpic);

        echo '<script>';
        echo 'alert("课程删除成功");';
        echo 'location.href="DeleteCourse.php?p=0";';
        echo '</script>';
    }else{
        echo '<script>';
        echo 'alert("课程删除失败，请重新删除");';
        echo 'location.href="DeleteCourse.php?p=0";';
        echo '</script>';
    }

