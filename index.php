<?php
session_start();

if(isset($_COOKIE['username'])){
    header('Location:main.php');
    exit();
}
//如果合法用户曾经登录过，就直接引导该用户到符合自己身份的界面
if($_SESSION) {
    if ($_SESSION['role'] == 'teacher') {
        header('Location:DeleteCourse.php');
        exit();
    } else if ($_SESSION['role'] == 'student') {
        header('Location:DropCourse.php');
        exit();
    }
}
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>任选课网上选课系统</title>
    <link rel="stylesheet" type="text/css" href="greenspan.css"/>
</head>
<body>
<div id="outside">
    <div id="permlink">
        <a href="">学校主页</a>
        <a href="">教务处</a>
        <a href="">学生处</a>
    </div><!-- end of permlink -->

    <div id="header">
        <h1>任选课网上选课系统</h1>
    </div><!-- end of header -->

    <div id="topnav">
        <a href="">学校主页</a>
        <a href="">学生处</a>
        <a href="">团委</a>
        <a href="">公共服务</a>
        <a href="">关于本系统</a>
    </div><!-- end of topnav -->

    <div id="left">
        <div class="box">
            <h3>用户登录</h3>
            <form action="ChkLogin.php" method="post">
                <p>
                    用户名 <br/><input type="text" name="username" size="10"/><br/>
                    密码<br/> <input type="password" name="userpwd" size="12"/><br/>
                    您的身份<br/>
                    <select name="role">
                        <option value="student">学生</option>
                        <option value="teacher">教师</option>
                    </select><br/>
                    cookie设定<br/>
                    <select name="cookie" id="cookie">
                        <option value="0" selected>浏览器进程</option>
                        <option value="1">保存1天</option>
                        <option value="2">保存30天</option>
                        <option value="3">保存365天</option>
                    </select><br/>
                    <input type="submit" value="确定" name="ok"/><input type="reset" value="重置" name="reset"/>
                </p>
            </form>
            您是第<font color="#000ff">
                <?php
                include("counter.php");
                echo $image;
                ?>
            </font>个访问者
        </div><!-- end of box -->

        <div class="box">
            <h3>快速链接</h3>
            <ul>
                <li><a href="">使用方法</a></li>
                <li><a href="">常见问题</a></li>
                <li><a href="">联系我们</a></li>
            </ul>
        </div><!-- end of box -->
    </div><!-- end of left -->

    <div id="middle">
        <div class="box">
            <h3>随机课程展示</h3>
            <?php
                include("db_conn.php");
                include("db_func.php");
                include("rand_couinfo.php");
                echo rand_couinfo();
            ?>
        </div><!-- end of box -->
    </div><!-- end of middle -->
</div><!-- end of outside -->
</body>
</html>
