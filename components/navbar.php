<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top flex-column py-1 px-2">
  <div class="container-fluid w-100 d-flex align-items-center">
    <div class="col-12 col-sm-4 col-lg-6 text-center"><a class="navbar-brand d-block" href="index.php">synth</a></div>
    <div class="col-8 col-sm-4">
      <form class="d-flex ms-3" role="search">
        <input class="form-control" type="search" placeholder="尋找商品......" aria-label="Search" />
        <button class="btn fs-4 d-block" type="submit"><i class="bi bi-search"></i></button>
      </form>
    </div>
    <div class="col-2 text-center text-lg-end"><button class="btn fs-4 position-relative"><i class="bi bi-cart"></i><span class="position-absolute top-50 start-50 translate-x badge rounded-pill bg-danger" style="font-size: 40%;">3</span></button></div>
    <div class="col-1 text-center d-lg-none"><button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavList" aria-controls="navbarNavList" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button></div>
  </div>
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarNavList">
      <div class="navbar-nav d-sm-flex w-100 justify-content-between flex-sm-row">
        <div class="d-md-flex w-75 gap-3 mx-3">
          <?php multiList(); ?>
        </div>
        <hr class="d-sm-none my-2">
        <div class="text-sm-end py-2">
          <!-- <a class="nav-link" href="#">會員中心</a> -->
          <button class="btn btn-outline-dark">登入</button>
          <button class="btn">註冊</button>
        </div>
      </div>
    </div>
  </div>
</nav>

<?php
function multiList()
{
  global $conn;
  $SQLstring = "SELECT * FROM pyclass WHERE level=1 ORDER BY sort";
  $pyclass01 = $conn->query($SQLstring);
?>
  <?php while ($pyclass01_Rows = $pyclass01->fetch()) { ?>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <?= $pyclass01_Rows['cname'] ?>
      </a>
      <?php
      $SQLstring = sprintf("SELECT * FROM pyclass WHERE level=2 AND uplink=%d ORDER BY sort", $pyclass01_Rows['classid']);
      $pyclass02 = $conn->query($SQLstring);
      ?>
      <ul class="dropdown-menu">
        <?php while ($pyclass02_Rows = $pyclass02->fetch()) { ?>
          <li><a class="dropdown-item" href="main.php?classid=<?= $pyclass02_Rows['classid']; ?>"><?= $pyclass02_Rows['cname']; ?></a></li>
        <?php }; ?>
      </ul>
    </li>
  <?php }; ?>
<?php }; ?>