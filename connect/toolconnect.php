<?php
//下面是数据库连接信息，修改为你自己的即可
$host = "127.0.0.1:3306";
$user = 'root';
$pwd = 'root';
$db = 'zjdata';
$mysqli=new mysqli($host,$user,$pwd,$db);
$mysqli->query("set names utf8");
echo $mysqli->error;

?>
