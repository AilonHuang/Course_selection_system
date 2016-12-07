<?php
/**
 * Created by PhpStorm.
 * User: yilun
 * Date: 2016/10/26
 * Time: 20:14
 */
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

$CouNo = $_GET['CouNo'];

$ModifyCourse_sql = "SELECT * FROM Course WHERE CouNo='$CouNo'";
$ModifyCourseResult = db_query($ModifyCourse_sql);
$row = db_fetch_array($ModifyCourseResult);
?>

<html>
<title>修改课程详细信息</title>
<body>
<center>
    <table>
        <tr>
            <td><img width="80" height="120" src="./uploadpics/<?php echo $CouNo.".jpg "?>" alt=""></td>
            <td>
                <form action="ModifyCourse2.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="CouNo" value="<?php echo $CouNo ?>">
                    <table>
                        <tr>
                            <td>编号</td>
                            <td><input type="text" name="CouNoNew" size="3" value="<?php echo $CouNo?>"></td>
                        </tr>
                        <tr>
                            <td>名称</td>
                            <td><input type="text" name="CouName" size="30" value="<?php echo $row['CouName'] ?>"></td>
                        </tr>
                        <tr>
                            <td>类型</td>
                            <td><?php echo $row['Kind']?>
                                <select name="Kind">
                                    <option value="信息技术">信息技术</option>
                                    <option value="工程技术">工程技术</option>
                                    <option value="人文">人文</option>
                                    <option value="管理">管理</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>学分</td>
                            <td><input type="text" name="Credit" size="2" value="<?php echo $row['Credit'] ?>"></td>
                        </tr>
                        <tr>
                            <td>教师</td>
                            <td><input type="text" name="Teacher" size="20" value="<?php echo $row['Teacher'] ?>"></td>
                        </tr>
                        <tr>
                            <td>上课时间</td>
                            <td><input type="text" name="SchoolTime" size="20" value="<?php echo $row['SchoolTime'] ?>"></td>
                        </tr>
                        <tr>
                            <td>限定人数</td>
                            <td><input type="text" name="LimitNum" size="20" value="<?php echo $row['LimitNum'] ?>"></td>
                        </tr>
                        <tr>
                            <td>新图片</td>
                            <td><input type="file" name="photo"></td>
                        </tr>
                    </table>
                    <input type="submit" value="确定" name="B1">
                    <input type="reset" value="重置" name="B2">
                </form>
            </td>
        </tr>
    </table>
</center>
</body>
</html>
