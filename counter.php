<?php
/**
 * Created by PhpStorm.
 * User: yilun
 * Date: 2016/10/24
 * Time: 22:57
 */
$fp = fopen("counter.txt","r+");
$counter = fgets($fp,80);
$counter = doubleval($counter) + 1;
fseek($fp,0);
fputs($fp,$counter);
$n = strlen("$counter");
$image ='';
for($i=0;$i<$n;$i++){
    $gra_counter = substr($counter, $i, 1);//抓取每一个字符
    $image = $image . "<img width=10 height=10 src='images/" . $gra_counter . ".jpg'>";//将每一个抓取的字符对应的GIF文件
}
fclose($fp);