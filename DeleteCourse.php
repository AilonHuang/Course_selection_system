<?php
/**
 * Created by PhpStorm.
 * User: yilun
 * Date: 2016/10/27
 * Time: 19:09
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

include 'db_conn.php';
include 'db_func.php';

$DeleteCourse_sql = "SELECT * FROM `Course` WHERE DepartNo='$DepartNo' ORDER BY CouNo";

$DeleteCourseResult = db_query($DeleteCourse_sql);

?>
<center>删除课程
<form action="DeleteCourse1.php" method="post">
    <table width="660" border="0" align="center" cellpadding="0" cellspacing="1">
        <tr bgcolor="#0066cc">
            <td width="60"><font color="#fff" align="center">请选择</font></td>
            <td width="80" align="center"><font color="#fff">课程编码</font></td>
            <td width="220" align="center"><font color="#fff">课程名称</font></td>
            <td width="80" align="center"><font color="#fff">课程类别</font></td>
            <td width="50" align="center"><font color="#fff">学分</font></td>
            <td width="80" align="center"><font color="#fff">任课教师</font></td>
            <td width="100" align="center"><font color="#fff">上课时间</font></td>
        </tr>
        <?php
        //获取结果集合的行数
        $number = db_num_rows($DeleteCourseResult);

        //若表中有数据
        if($number>0) {
            $p = $_GET['p'];

            //每页抓取10条数据
            $check = $p+10;
            for ($i=0;$i<$number;$i++){
                $row = db_fetch_array($DeleteCourseResult);
                if($i>=$p && $i<$check){
                    if($i%2 == 0)
                        echo '<tr bgcolor="#ddd">';
                    else
                        echo '<tr>';
                    echo '<td width="60" align="center"><input type="checkbox" name="CouNo[]" value="'.$row['CouNo'].'"></td> ';
                    echo '<td width="80" align="center"><a href="DeleteCourse2.php?CouNo='.$row['CouNo'].'">'.$row['CouNo'].'</a></td>';
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
    <input type="submit" value="确定" name="B1">
    <input type="reset" value="重置" nmae="B2">
</form>
</center>

<br/>
</table>
<br>
<table width="400" border="0" align="center">
    <tr>
        <td align="center">
            <a href="DeleteCourse.php?p=0">第一页</a>
        </td>
        <td align="center">
            <?php
            if($p>9){
                $last = (floor($p/10)*10)-10;
                echo "<a href='DeleteCourse.php?p=$last'>上一页</a>";
            }else {
                echo '上一页';
            }
            ?>
        </td>
        <td align="center">
            <?php
            if($i>9 and $number > $check){
                echo "<a href='DeleteCourse.php?p=$j'>下一页</a>";
            }else
                echo '下一页';
            ?>
        </td>
        <td align="center">
            <?php
            if($i>10){
                $final = floor($number/10)*10;
                echo "<a href='DeleteCourse.php?p=$final'>最后一页</a>";
            }else
                echo '最后一页';
            ?>
        </td>
    </tr>
</table>
</body>
</html>

