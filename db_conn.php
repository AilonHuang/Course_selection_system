<?php
/**
 * Created by PhpStorm.
 * User: yilun
 * Date: 2016/10/25
 * Time: 20:58
 */
$DB_HOST = "localhost";
$DB_LOGIN = "root";
$DB_PASSWORD = "123456";
$DB_NAME = "Xk";
$conn = @mysql_connect($DB_HOST, $DB_LOGIN, $DB_PASSWORD);
mysql_select_db($DB_NAME);
mysql_query("SET NAMES UTF8");