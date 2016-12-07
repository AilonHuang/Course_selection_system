<?php
session_start();

if(!isset($_SESSION['username'])){
    header('Location:index.php');
    exit();
}else if($_SESSION['role'] != 'teacher'){
    header('Location:student.php');
    exit();
}
?>
<html>
<title>添加课程</title>
<body>
<center>
    请输入课程信息
    <form action="AddCourse1.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>编号</td>
                <td><input type="text" name="CouNo" size="3"></td>
            </tr>
            <tr>
                <td>名称</td>
                <td><input type="text" name="CouName" size="30"></td>
            </tr>
            <tr>
                <td>类型</td>
                <td>
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
                <td><input type="text" name="Credit" size="2"></td>
            </tr>
            <tr>
                <td>教师</td>
                <td><input type="text" name="Teacher" size="20"></td>
            </tr>
            <tr>
                <td>上课时间</td>
                <td><input type="text" name="SchoolTime" size="20"></td>
            </tr>
            <tr>
                <td>限定人数</td>
                <td><input type="text" name="LimitNum" size="20"></td>
            </tr>
            <tr>
                <td>图片</td>
                <td><input type="file" name="photo"></td>
            </tr>
        </table>
        <input type="submit" value="确定" name="B1">
        <input type="reset" value="重置" name="B2">
    </form>
</center>
</body>
</html>