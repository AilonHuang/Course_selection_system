<?php
/**
 * Created by PhpStorm.
 * User: yilun
 * Date: 2016/10/25
 * Time: 22:13
 */
session_start();

if($_SESSION) {
    if ($_SESSION['role'] == "teacher") {
        header("Location:DeleteCourse.php");
        exit();
    } else if ($_SESSION['role']) {
        header("Location:DropCourse.php");
        exit();
    }
}

include("db_conn.php");
include("db_func.php");

$username = $_POST['username'];
$username = trim($username);
$userpwd = $_POST['userpwd'];
$userpwd = trim($userpwd);
$role = $_POST['role'];
$cookie = $_POST['cookie'];

if($username == '' || $userpwd == ''){
    echo "<script>";
    echo "alert(\"用户名或密码不能为空，请重新登录\");";
    echo "location.href = \"index.php\";";
    echo "</script>";
}else{
    if($role == "teacher"){
        $ChkLogin = "SELECT * FROM Teacher WHERE TeaNo = '$username'";
    }else{
        $ChkLogin = "SELECT * FROM Student WHERE StuNo = '$username'";
    }

    $ChkLoginResult = db_query($ChkLogin);
    $number = db_num_rows($ChkLoginResult);
    $row = db_fetch_array($ChkLoginResult);

    if (StrCmp($row['Pwd'], $userpwd) == 0){
        switch($cookie){
            case 0:
//                setcookie('username',$row[0]);
//                header('location: main.php');
                break;
            case 1:
                setcookie('username',$row[0],time()+24*60*60);
                header('location: main.php');
                break;
            case 2:
                setcookie('username',$row[0],time()+30*24*60*60);
                header('location: main.php');
                break;
            case 3:
                setcookie('username',$row[0],time()+365*24*60*60);
                header('location: main.php');
                break;
        }
        if($role == 'teacher'){
            $_SESSION['role'] = 'teacher';
            $_SESSION['username'] = $row['TeaNo'];
            $_SESSION['departno'] = $row['DepartNo'];
            header('Location:DeleteCourse.php');
        }else{
            $_SESSION['role'] = 'student';
            $_SESSION['username'] = $row['StuNo'];
            $_SESSION['classno'] = $row['ClassNo'];
            header('Location:TakeCourse.php');
            echo 'test';
        }
    }else{
        echo "<script>";
        echo "alert(\"错误的用户名或密码，请重新登录\");";
        echo "location.href = \"index.php\";";
        echo "</script>";
    }
}