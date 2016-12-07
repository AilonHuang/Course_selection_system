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

//判断该生志愿数是够已经超过5个
$GetTotal_sql = "SELECT * FROM StuCou WHERE StuNo='$StuNo'";
$GetTotalResult = db_query($GetTotal_sql);
$MaxNum = db_num_rows($GetTotalResult);
if($MaxNum<5){
    echo '<center>';
    echo '您还没选满5门课程，点击课程编码链接可以查看课程细节并选择该门课程';
    echo '</center>';
}else{
    echo '<center>';
    echo '您已经选满5门课程，点击课程编码链接可以查看课程细节';
    echo '</center>';
}

//提取该生没有选过的课程信息
$ShowCourse_sql = "SELECT * FROM Course WHERE CouNo NOT IN (SELECT CouNo FROM StuCou WHERE StuNo='$StuNo') ORDER BY CouNo";
$ShowCourseResult = db_query($ShowCourse_sql);
?>

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
    if(db_num_rows($ShowCourseResult)>0){
        $number = db_num_rows($ShowCourseResult);
        $p = $_GET['p'];
        $check = $p + 10;
        for ($i=0;$i<$number;$i++){
            $row = db_fetch_array($ShowCourseResult);
            if($i>=$p && $i<$check){
                if($i%2 == 0)
                    echo '<tr bgcolor="#ddd">';
                else
                    echo '<tr>';
                echo '<td width="80" align="center"><a href="TakeCourse1.php?CouNo='.$row['CouNo'].'&MaxNum='.$MaxNum.'">'.$row['CouNo'].'</a></td>';
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
            <a href="ShowCourse.php?p=0">第一页</a>
        </td>
        <td align="center">
            <?php
            if($p>9){
                $last = (floor($p/10)*10)-10;
                echo "<a href='ShowCourse.php?p=$last'>上一页</a>";
            }else {
                echo '上一页';
            }
            ?>
        </td>
        <td align="center">
            <?php
            if($i>9 and $number > $check){
                echo "<a href='ShowCourse.php?p=$j'>下一页</a>";
            }else
                echo '下一页';
            ?>
        </td>
        <td align="center">
            <?php
            if($i>10){
                $final = floor($number/10)*10;
                echo "<a href='ShowCourse.php?p=$final'>最后一页</a>";
            }else
                echo '最后一页';
            ?>
        </td>
    </tr>
</table>
</body>
</html>
