<?php
// 建立MySQL的資料庫連接 
$conn = mysqli_connect(
        "localhost",
        "root",
        "",
        "web"
)
        or die("Can not open MySQL database!<br/>");
mysqli_query($conn, "set names 'UTF8' ");
