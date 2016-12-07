<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location:index.php");
    exit();
}else if($_SESSION['role'] != 'teacher'){
    header("Location:student.php");
    exit();
}

include('db_conn.php');
include 'db_func.php';

$ShowCourse_sql = 'SELECT * FROM Course ORDER BY CouNo';
$ShowCourseResult = db_query($ShowCourse_sql);
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf8"/>
    <title>课程信息显示</title>
</head>
<body>
<center>点击课程编码链接可以修改课程细节</center>
<table width="610" border="0" align="center" cellpadding="0" cellspacing="1">
    <tr bgcolor="#0066cc">
        <td width="80" align="center"><font color="#fff">课程编码</font></td>
        <td width="220" align="center"><font color="#fff">课程名称</font></td>
        <td width="80" align="center"><font color="#fff">课程类别</font></td>
        <td width="50" align="center"><font color="#fff">学分</font></td>
        <td width="80" align="center"><font color="#fff">任课教师</font></td>
        <td width="100" align="center"><font color="#fff">上课时间</font></td>
    </tr>
    <?php
    //获取结果结果集合的行数
    $number = db_num_rows($ShowCourseResult);

    //若表中有数据
    if($number>0){
        $p = $_GET['p'];
        //每页抓取10笔数据
        $check = $p + 10;
        for ($i=0;$i<$number;$i++){
            $row = db_fetch_array($ShowCourseResult);

            if($i>=$p && $i<$check){
                if($i%2 == 0)
                    echo '<tr bgcolor="#ddd">';
                else
                    echo '<tr>';
                echo '<td width="80" align="center"><a href="ModifyCourse1.php?CouNo='.$row['CouNo'].'">'.$row['CouNo'].'</a></td>';
                echo '<td width="220">'.$row['CouName'].'</td>';
                echo '<td width="80">'.$row['Kind'].'</td>';
                echo '<td width="50">'.$row['Credit'].'</td>';
                echo '<td width="80">'.$row['Teacher'].'</td>';
                echo '<td width="100">'.$row['SchoolTime'].'</td>';
                echo '</tr>';
                $j = $i + 1;
            }
        }
    }
    ?>
</table>
<br>
<table width="400" border="0" align="center">
    <tr>
        <td align="center">
            <a href="ModifyCourse.php?p=0">第一页</a>
        </td>
        <td align="center">
            <?php
            if($p>9){
                $last = (floor($p/10)*10)-10;
                echo "<a href='MOdifyCourse.php?p=$last'>上一页</a>";
            }else {
                echo '上一页';
            }
            ?>
        </td>
        <td align="center">
            <?php
            if($i>9 and $number > $check){
                echo "<a href='MOdifyCourse.php?p=$j'>下一页</a>";
            }else
                echo '下一页';
            ?>
        </td>
        <td align="center">
            <?php
            if($i>10){
                $final = floor($number/10)*10;
                echo "<a href='MOdifyCourse.php?p=$final'>最后一页</a>";
            }else
                echo '最后一页';
            ?>
        </td>
    </tr>
</table>
</body>
</html>
