<?php require_once('connections/conn_db.php'); ?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
  <?php require_once('components/head.php') ?>
</head>

<body>
  <!-- back to top button -->
  <?php require_once('components/backToTop.php') ?>

  <!-- navbar -->
  <?php require_once('components/navbar.php') ?>

  <main>
    <div class="container-fluid g-0">
      <!-- big pic -->
      <?php require_once('components/indexMainPic.php') ?>

      <!-- top sale products -->
      <?php require_once('components/topSales.php') ?>
    </div>
  </main>

  <footer>
    <?php require_once('components/footer.php') ?>
  </footer>

  <?php require_once('components/js.php') ?>
</body>

</html>