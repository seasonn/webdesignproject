<?php
session_start();
function checkpasswddb($id, $pass)
{
   include "../Connections/conn_db.php";
   // $sql="select * from admin where aid='$id'";
   $sql = "select * from admin where aid = ?";
   $result = $link->prepare($sql);
   $aid[] = $id;
   $result->execute($aid);
   //$result=$statement->fetchAll(PDO::FETCH_ASSOC);
   // $result=$link->query($sql);
   if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      if ($pass == $row['passwd'])
         return 0;
      else
         return 2;
   } else
      return 1;
}
$id = "";
$password = "";
$err = "";

if (isset($_GET['st'])) { //logout 時會給的變數
   if ($_GET['st'] == "logout") {
      unset($_SESSION['account']);
   }
}

if (isset($_POST['fID'])) {
   $id = $_POST['fID'];
   $password = $_POST['fPassword'];
   $code = checkpasswddb($id, $password);
   // echo "code=".$code;
   if ($code == 0) {
      $_SESSION['sLogintime'] = date("F j, Y, g:i a");
      $_SESSION['account'] = $id;
      header("Location: index.php");
   } elseif ($code == 1)
      $err = "帳號錯誤";
   else
      $err = "密碼錯誤";
}
?>

<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <title>後端管理系統</title>

   <!-- ================= Favicon ================== -->
   <!-- Standard -->
   <link rel="shortcut icon" href="logo/fav.png">
   <!-- Retina iPad Touch Icon-->
   <link rel="apple-touch-icon" sizes="144x144" href="logo/fav.png">
   <!-- Retina iPhone Touch Icon-->
   <link rel="apple-touch-icon" sizes="114x114" href="logo/fav.png">
   <!-- Standard iPad Touch Icon-->
   <link rel="apple-touch-icon" sizes="72x72" href="logo/fav.png">
   <!-- Standard iPhone Touch Icon-->
   <link rel="apple-touch-icon" sizes="57x57" href="logo/fav.png">

   <!-- Styles -->
   <link href="assets/fontAwesome/css/fontawesome-all.min.css" rel="stylesheet">
   <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
   <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
   <link href="assets/css/lib/nixon.css" rel="stylesheet">
   <link href="assets/css/style.css" rel="stylesheet">
</head>

<body class="bg-primary">
   <div class="Nixon-login">
      <div class="container">
         <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
               <div class="login-content">
                  <div class="login-logo">
                     <h2><img id="" src="logo/logoSmall.png" style="width:50px;height:43px;" />後端管理系統</h2>
                  </div>
                  <div class="login-form">
                     <h4>帳號登錄</h4>
                     <form method="post" action="login.php">
                        <div class="form-group">
                           <label>帳號</label>
                           <input type="text" name="fID" value="<?= $id ?>" class="form-control" placeholder="帳號">
                        </div>
                        <div class="form-group">
                           <label>密碼</label>
                           <input type="password" name="fPassword" value="<?= $password ?>" class="form-control" placeholder="密碼">
                        </div>
                        <div>
                           <label>
                              <?= $err ?>
                           </label>
                           <label class="pull-right">
                           </label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">登入</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</body>
</html>