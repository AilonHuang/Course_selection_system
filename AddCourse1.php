<?php
/**
 * Created by PhpStorm.
 * User: yilun
 * Date: 2016/10/26
 * Time: 19:19
 */
session_start();

if(!isset($_SESSION['username'])){
    header('Location:index.php');
    exit();
}else if($_SESSION['role'] != 'teacher'){
    header('Location:student.php');
    exit();
}

include('db_conn.php');
include 'db_func.php';

$CouNo = $_POST['CouNo'];
$CouName = $_POST['CouName'];
$Kind = $_POST['Kind'];
$Credit = $_POST['Credit'];
$Teacher = $_POST['Teacher'];
$SchoolTime = $_POST['SchoolTime'];
$LimitNum = $_POST['LimitNum'];


//对用户输入的字符进行预处理
$CouNo = trim($CouNo);
$CouName = trim($CouName);
$Credit = trim($Credit);
$Teacher = trim($Teacher);
//从会话中获取系部编号
$DepartNo = $_SESSION['departno'];
$SchoolTime = trim($SchoolTime);
$LimitNum = trim($LimitNum);

$AddCourse_sql = "INSERT INTO Course VALUES ('$CouNo','$CouName','$Kind','$Credit','$Teacher','$DepartNo','$SchoolTime','$LimitNum',0)";


//生成包含相对路径的图片文件名
$target_path = './uploadpics/'.$CouNo.'.jpg';
//将图片按照生成的文件名转移到目标路径中
move_uploaded_file($_FILES['photo']['tmp_name'],$target_path);

if(file_exists($target_path)){
    $AddCourseResult = db_query($AddCourse_sql);

    if($AddCourseResult){
        echo '<script>';
        echo 'alert("添加课程成功");';
        echo 'location.href="Teacher.php";';
        echo '</script>';
    }else{
        //添加课程失败，删除刚才上传的图片
        unlink($target_path);
        echo '<script>';
        echo 'alert("添加课程失败，请重新添加");';
        echo 'location.href="AddCourse.php";';
        echo '</script>';
    }
}else{
    echo '<script>';
    echo 'alert("添加课程失败，请重新添加");';
    echo 'location.href="AddCourse.php";';
    echo '</script>';
}

