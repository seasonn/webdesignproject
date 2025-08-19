<?php
$dsn = "mysql:host=localhost;dbname=expstore;charset=utf8";
$user= "sales";
$pwd="123456";
$link = new PDO($dsn, $user, $pwd);
date_default_timezone_set("Asia/Taipei");
?>