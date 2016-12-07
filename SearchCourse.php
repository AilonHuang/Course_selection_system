<?php
/**
 * Created by PhpStorm.
 * User: yilun
 * Date: 2016/10/26
 * Time: 16:56
 */
session_start();
//必须登录后才可使用
if(!isset($_SESSION['username'])){
    header('Location:index.php');
    exit();
}
?>
<html>
<title>查询课程信息</title>
<body>
<center>
    <form action="SearchCourse1.php" method="get">
        <teble>
            <tr><td align="center">请输入查询信息</td></tr>
            <tr>
                <td>查询
                    <select name="ColumnName">
                        <option value="CouNo">课程编号</option>
                        <option value="CouName">课程名称</option>
                        <option value="Kind">类型</option>
                        <option value="Credit">学分</option>
                        <option value="Teacher">教师</option>
                        <option value="DepartName">开课系部</option>
                        <option value="SchoolTime">上课时间</option>
                    </select>
                    为
                    <input type="text" name="KeyWord" size="20">的课程
                </td>
            </tr>
        </teble>
        <input type="submit" value="确定" name="B1">
        <input type="reset" value="重置" name="B2">
    </form>
</center>
</body>
</html>
