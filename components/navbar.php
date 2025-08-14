<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top flex-column p-0">
  <div class="container-fluid w-100 d-flex align-items-center py-2">
    <a class="navbar-brand text-md-start text-center ms-sm-5 col-12 col-sm-3" href="index.php">synth</a>
    </button>
    <form class="d-flex col-9 col-sm-5 ms-3" role="search">
      <input class="form-control" type="search" placeholder="尋找商品......" aria-label="Search" />
      <button class="btn" type="submit"><i class="fas fa-magnifying-glass"></i></button>
    </form>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavList"
      aria-controls="navbarNavList" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
  <div class="container-fluid">
    <div class="collapse navbar-collapse pb-2" id="navbarNavList">
      <div class="navbar-nav d-sm-flex w-100 justify-content-between flex-sm-row">
        <div class="d-md-flex w-75 gap-3 mx-3">
          <?php multiList(); ?>
        </div>
        <hr class="d-sm-none gap-2 mb-2">
        <div class="text-sm-end">
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