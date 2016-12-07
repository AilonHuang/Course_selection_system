<?php
/**
 * Created by PhpStorm.
 * User: yilun
 * Date: 2016/10/26
 * Time: 17:01
 */
session_start();
//必须登录后才可使用
if(!isset($_SESSION['username'])){
    header('Location:index.php');
    exit();
}

$ColumnName = $_GET['ColumnName'];
$KeyWord = $_GET['KeyWord'];
$KeyWord = trim($KeyWord);

include "db_conn.php";
include "db_func.php";
switch($ColumnName){
    case "CouNo":
        $SearchCourse_sql = "SELECT * FROM Course WHERE CouNo LIKE '%$KeyWord%'";
        break;
    case "CouName":
        $SearchCourse_sql = "SELECT * FROM Course WHERE CouName LIKE '%$KeyWord%'";
        break;
    case "Kind":
        $SearchCourse_sql = "SELECT * FROM Course WHERE Kind LIKE '%$KeyWord%'";
        break;
    case "Credit":
        $SearchCourse_sql = "SELECT * FROM Course WHERE Credit LIKE '%$KeyWord%'";
        break;
    case "Teacher":
        $SearchCourse_sql = "SELECT * FROM Course WHERE Teacher LIKE '%$KeyWord%'";
        break;
    case "DepartName":
        $SearchCourse_sql = "SELECT * FROM Course, Department WHERE Course.DepartNo = Department.DepartNo AND DepartName LIKE '%$KeyWord%'";
        break;
    case "SchoolTime":
        $SearchCourse_sql = "SELECT * FROM Course WHERE SchoolTime LIKE '%$KeyWord%'";
        break;

}
$SearchCourseResult = db_query($SearchCourse_sql);
?>
<center>点击课程编码链接可以查看课程细节</center>
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
    if(db_num_rows($SearchCourseResult)>0){
        $number = db_num_rows($SearchCourseResult);
        $p = $_GET['p'];
        //var_dump($_GET);
        $check = $p + 10;
        for ($i=0;$i<$number;$i++){
            $row = db_fetch_array($SearchCourseResult);
            if($i>=$p && $i<$check){
                if($i%2 == 0)
                    echo '<tr bgcolor="#ddd">';
                else
                    echo '<tr>';
                echo '<td width="80" align="center"><a href="CourseDetail.php?CouNo='.$row['CouNo'].'">'.$row['CouNo'].'</a></td>';
                echo '<td width="220">'.$row['CouName'].'</td>';
                echo '<td width="80">'.$row['Kind'].'</td>';
                echo '<td width="50">'.$row['Credit'].'</td>';
                echo '<td width="80">'.$row['Teacher'].'</td>';
                echo '<td width="100">'.$row['SchoolTime'].'</td>';
                echo '</tr>';
                $j = $i + 1;
            }
        }
    }else{
        echo '<script>';
        echo 'alert("搜索不到任何结果，返回继续");';
        echo 'location.href = "SearchCourse.php";';
        echo '</script>';
        die;
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
            echo $p;
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

