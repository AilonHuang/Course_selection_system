<?php
/**
 * Created by PhpStorm.
 * User: yilun
 * Date: 2016/10/25
 * Time: 21:05
 */
function rand_couinfo(){
    //取得表中的课程数BEGIN
    $SQLStr = "SELECT COUNT(*) FROM Course";
    $res = db_query($SQLStr);
    $row = db_fetch_array($res);
    $total = $row[0];
    //取的表中的课程数END

    //取出所有课程数据BEGIN
    $SQLStr = "SELECT * FROM Course, Department WHERE Course.DepartNo = Department.DepartNo";

    $res = db_query($SQLStr);
    //取出所有课程数据END

    //产生随机种子
    srand((double)microtime()*1000000);

    //为$num随机赋值
    $num = rand(0,$total - 1);
    //抓取表中第$num笔数据
    db_data_seek($res, $num);
    $row  = db_fetch_array($res);

    //呈现随机选出的课程信息和图片
    return "<div align='center'><h3>课程细节</h3></div>
        <table width='400'>
            <tr>
                <td rowspan='8' colspan='8'><img width='80' height='120' src='./uploadpics/". $row['CouNo'] .".jpg' border='0' alt=''></td>
                <td bgcolor='#ddd'>编号</td>
                <td bgcolor='#ddd'>". $row['CouNo']. "</td>
            </tr>
            <tr>
                <td>名称</td>
                <td>". $row['CouName'] ."</td>
            </tr>
            <tr>
                <td bgcolor='#ddd'>类型</td>
                <td bgcolor='#ddd'>". $row['Kind'] ."</td>
            </tr>
            <tr>
                <td>学分</td>
                <td>". $row['Credit']. "</td>
            </tr>
            <tr>
                <td bgcolor='#ddd'>任课教师</td>
                <td bgcolor='#ddd'>". $row['Teacher'] ."</td>
            </tr>
            <tr>
                <td>开课系部</td>
                <td>". $row['DepartName'] ."</td>
            </tr>
            <tr>
                <td bgcolor='#ddd'>上课时间</td>
                <td bgcolor='#ddd'>". $row['SchoolTime'] ."</td>
            </tr>
            <tr>
                <td>限定人数</td>
                <td>". $row['LimitNum'] ."</td>
            </tr>
        </table>
    ";
}


//var_dump($row);
?>


