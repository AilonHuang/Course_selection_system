<?php
/**
 * Created by PhpStorm.
 * User: yilun
 * Date: 2016/10/27
 * Time: 19:53
 */
session_start();
if(!isset($_SESSION['username'])){
    header('Location:index.php');
    exit();
}else if($_SESSION['role'] != 'student'){
    header('Location:teacher.php');
    exit();
}

include('db_conn.php');
include 'db_func.php';

$StuNo = $_SESSION['username'];

//提取该生没有选过的课程信息
$ShowCourse_sql = "SELECT * FROM Course,StuCou WHERE StuNo='$StuNo' AND Course.CouNo=StuCou.CouNo ORDER BY WillOrder";
$ShowCourseResult = db_query($ShowCourse_sql);
?>
<html>
<title>显示与调整选课信息</title>
<body>
<center>点击课程编码链接可查看课程细节，点击删除链接可以删除该选择</center>
<table width="690" border="0" align="center" cellpadding="0" cellspacing="1">
    <tr bgcolor="#0066cc">
        <td width="80" align="center"><font color="#fff">志愿顺序</font></td>
        <td width="80" align="center"><font color="#fff">删除选择</font></td>
        <td width="80" align="center"><font color="#fff">课程编码</font></td>
        <td width="220" align="center"><font color="#fff">课程名称</font></td>
        <td width="80" align="center"><font color="#fff">课程类别</font></td>
        <td width="50" align="center"><font color="#fff">学分</font></td>
        <td width="80" align="center"><font color="#fff">任课教师</font></td>
        <td width="100" align="center"><font color="#fff">上课时间</font></td>
    </tr>
    <?php
    if(db_num_rows($ShowCourseResult)>0){
        $number = db_num_rows($ShowCourseResult);

        for ($i=0;$i<$number;$i++){
            $row = db_fetch_array($ShowCourseResult);

            if($i%2 == 0)
                echo '<tr bgcolor="#ddd">';
            else
                echo '<tr>';
            echo '<td width="80" align="center">'.$row['WillOrder'].'</td>';
            echo '<td width="80" align="center"><a href="DropCourse1.php?CouNo='.$row['CouNo'].'&WillOrder='.$row['WillOrder'].'">删除</a></td>';
            echo '<td width="80" align="center"><a href="DropCourse2.php?CouNo='.$row['CouNo'].'&WillOrder='.$row['WillOrder'].'">'.$row['CouNo'].'</a></td>';
            echo '<td width="220">'.$row['CouName'].'</td>';
            echo '<td width="80">'.$row['Kind'].'</td>';
            echo '<td width="50">'.$row['Credit'].'</td>';
            echo '<td width="80">'.$row['Teacher'].'</td>';
            echo '<td width="100">'.$row['SchoolTime'].'</td>';
            echo '</tr>';
        }
    }
    ?>
</table>
</body>
</html>
