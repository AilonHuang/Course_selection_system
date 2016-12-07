<?php
/**
 * Created by PhpStorm.
 * User: yilun
 * Date: 2016/10/27
 * Time: 20:39
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
$CouNo = $_GET['CouNo'];
$MaxNum = $_GET['MaxNum'];

$ShowCourse_sql = "SELECT * FROM Course, Department WHERE CouNo='$CouNo' AND Course.DepartNo=Department.DepartNo";

$ShowCourseResult = db_query($ShowCourse_sql);
$row = db_fetch_array($ShowCourseResult);

?>

<html>
<title>显示课程详细信息</title>
<body>
<center>
    <table>
        <tr bgcolor="#0066cc">
            <td colspan="3" columspan="2"><div align="center"><font color="#fff">课程细节</font></div></td>
        </tr>
        <tr>
            <td rowspan='8'><img width='80' height='120' src='./uploadpics/<?php echo $row['CouNo'] ?>.jpg' border='0' alt=''></td>
            <td bgcolor='#ddd'>编号</td>
            <td bgcolor='#ddd'><?php echo $row['CouNo'] ?></td>
        </tr>
        <tr>
            <td>名称</td>
            <td><?php echo $row['CouName'] ?></td>
        </tr>
        <tr>
            <td bgcolor='#ddd'>类型</td>
            <td bgcolor='#ddd'><?php echo $row['Kind'] ?></td>
        </tr>
        <tr>
            <td>学分</td>
            <td><?php echo $row['Credit'] ?></td>
        </tr>
        <tr>
            <td bgcolor='#ddd'>任课教师</td>
            <td bgcolor='#ddd'><?php echo $row['Teacher'] ?></td>
        </tr>
        <tr>
            <td>开课系部</td>
            <td><?php echo $row['DepartName'] ?></td>
        </tr>
        <tr>
            <td bgcolor='#ddd'>上课时间</td>
            <td bgcolor='#ddd'><?php echo $row['SchoolTime'] ?></td>
        </tr>
        <tr>
            <td>限定人数</td>
            <td><?php echo $row['LimitNum'] ?></td>
        </tr>
    </table>
    <?php
    //判断该生已选择的课程数是否小于5门。如果小于5门则显示选课按钮
    if($MaxNum<5){
    ?>
        <form action="TakeCourse2.php" method="post">
            <input type="hidden" name="CouNo" value="<?php echo $CouNo ?>">
            <input type="hidden" name="MaxNum" value="<?php echo $MaxNum ?>">
            <input type="submit" value="选择该课程">
        </form>
    <?php
    }
    ?>
</center>
</body>
</html>

