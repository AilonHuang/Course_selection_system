<?php

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
$CouNoNew = $_POST['CouNoNew'];
$CouName = $_POST['CouName'];
$Kind = $_POST['Kind'];
$Credit = $_POST['Credit'];
$Teacher = $_POST['Teacher'];
$SchoolTime = $_POST['SchoolTime'];
$LimitNum = $_POST['LimitNum'];


//对用户输入的字符进行预处理
$CouNoNew = trim($CouNoNew);
$CouName = trim($CouName);
$Credit = trim($Credit);
$Teacher = trim($Teacher);
//从会话中获取系部编号
$DepartNo = $_SESSION['departno'];
$SchoolTime = trim($SchoolTime);
$LimitNum = trim($LimitNum);

$ModifyCourse2_sql = "UPDATE Course SET CouNO='$CouNoNew',CouName='$CouName',Kind='$Kind',Credit='$Credit',Teacher='$Teacher',SchoolTime='$SchoolTime',LimitNum='$LimitNum' WHERE CouNo='$CouNo' AND DepartNo='$DepartNo'";
$ModifyCourse2_Result = db_query($ModifyCourse2_sql);
if (file_exists($_FILES['photo']['tmp_name'])){
    if($ModifyCourse2_Result){
        $oldpic = './uploadpics/'.$CouNo.'.jpg';
        if(file_exists($oldpic))
            unlink($oldpic);//删除原来的图片
        //上传新的图片
        $target_path = './uploadpics/'.$CouNoNew.'.jpg';
        move_uploaded_file($_FILES['photo']['tmp_name'],$target_path);
        echo '<script>';
        echo 'alert("修改课程成功");';
        echo 'location.href="ModifyCourse.php?p=0";';
        echo '</script>';
    }else{
        echo '<script>';
        echo 'alert("修改课程失败，请重新修改");';
        echo 'location.href="ModifyCourse.php?p=0";';
        echo '</script>';
    }
}else{
    if($ModifyCourse2_Result){
        echo '<script>';
        echo 'alert("修改课程成功");';
        echo 'location.href="ModifyCourse.php?p=0";';
        echo '</script>';
    }else{
        echo '<script>';
        echo 'alert("修改课程失败，请重新修改");';
        echo 'location.href="ModifyCourse.php?p=0";';
        echo '</script>';
    }
}


