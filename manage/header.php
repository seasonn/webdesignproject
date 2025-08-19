<?php
session_start();
if (!isset($_SESSION['account'])) {
    header("Location: login.php");
}
$sname = str_replace("detail.php", "", basename($_SERVER['PHP_SELF']));
$sname = str_replace("detailu.php", "", $sname);
$sname = str_replace(".php", "", $sname);
include "../Connections/conn_db.php";
$sql = "select * from mright left join programs on mright.sid = programs.sid where mright.aid='" . $_SESSION['account'] . "' and programs.program='" . $sname . "'";
$result = $link->query($sql);
if (!$row = $result->fetch()) {
    if (basename($_SERVER['PHP_SELF']) != "index.php")
        header("Location: index.php");
}
$sql = "select * from admin where aid='" . $_SESSION['account'] . "'";
$result = $link->query($sql);
$row = $result->fetch();
$aname = $row['aname'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>後台管理系統</title>

    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="logo/logosmall.png">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="logo/logosmall.png">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="logo/logosmall.png">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="logo/logosmall.png">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="logo/logosmall.png">

    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="assets/css/lib/mmc-chat.css" rel="stylesheet" />
    <link href="assets/css/lib/sidebar.css" rel="stylesheet">
    <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/lib/nixon.css" rel="stylesheet">

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <link href="../css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" crossorigin="anonymous">
    <link href="../themes/explorer-fa5/theme.css" media="all" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="../js/plugins/buffer.min.js" type="text/javascript"></script>
    <script src="../js/plugins/filetype.min.js" type="text/javascript"></script>
    <script src="../js/plugins/piexif.js" type="text/javascript"></script>
    <script src="../js/plugins/sortable.js" type="text/javascript"></script>
    <script src="../js/fileinput.js" type="text/javascript"></script>
    <script src="../js/locales/zh-TW.js" type="text/javascript"></script>
    <script src="../themes/gly/theme.js" type="text/javascript"></script>
    <script src="../themes/fa5/theme.js" type="text/javascript"></script>
    <script src="../themes/explorer-fa5/theme.js" type="text/javascript"></script>
    <link href="assets/css/style.css" rel="stylesheet">

    <style type="text/css">

    </style>
    <script>
        function redirectDialog(filename, msg) {
            alert(msg);
            location.replace(filename);
        }

        function deleteConfirm(filename, id) {
            if (confirm("警告:\n 確定刪除編號為" + id + "的資料嗎?") == 1) {
                location.replace(filename + "?mode=delete&id=" + id);
            } else
                return false;
        }
    </script>
</head>

<body>

    <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
        <div class="nano">
            <div class="nano-content">
                <ul>
                    <li><a href="index.php"><i class="ti-home"></i> 管理者首頁</a> </li>
                    <?php
                    $sql = "select sname,program from mright left join programs on mright.sid=programs.sid where aid='" . $_SESSION['account'] . "' order by mright.sid";
                    //        echo $sql;
                    $result = $link->query($sql);

                    while ($row = $result->fetch()) { ?>
                        <li><a href="<?= $row['program'] . ".php" ?>"><i class="ti-control-record"></i><?= $row['sname'] ?></a></li>
                    <?php }
                    ?>
                    <li><a href="login.php?st=logout"><i class="ti-close"></i> 登出</a></li>
                </ul>
            </div>
        </div>
    </div><!-- /# sidebar -->




    <div class="header">
        <div class="pull-left">
            <div class="logo">
                <a href="index.php">
                    <span style="font-size:18px;color:#fff; font-weight: bold;"><img id="logoImg" src="logo/logoSmall.png" data-logo_big="logo/logoSmall.png" data-logo_small="logo/logoSmall.png" />後台管理系統</span>
                </a>
            </div>
            <div class="hamburger sidebar-toggle">
                <span class="ti-menu"></span>
            </div>
        </div>


    </div>


    <!-- END chat Sidebar-->


    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 p-0">
                        <div class="page-header">
                            <div class="page-title">
                                <h1><?= $aname ?> 您好！登入時間：<?= $_SESSION['sLogintime'] ?></h1>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="main-content">