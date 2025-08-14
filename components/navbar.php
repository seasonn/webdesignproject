<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top flex-column p-0">
  <div class="container-fluid w-100 d-flex align-items-center py-2">
    <a class="navbar-brand text-md-start text-center ms-sm-5 col-12 col-sm-3" href="index.php">synth</a>
    </button>
    <form class="d-flex col-9 col-sm-5 ms-3" role="search">
      <input class="form-control" type="search" placeholder="尋找商品......" aria-label="Search" />
      <button class="btn" type="submit"><i class="fas fa-magnifying-glass"></i></button>
    </form>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
      aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
  <div class="container-fluid d-flex justify-content-around">
    <div class="collapse navbar-collapse pb-2" id="navbarNavAltMarkup">
      <div class="navbar-nav d-sm-flex w-100 justify-content-between flex-sm-row">
        <div class="d-md-flex gap-3 mx-3">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              合成器
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">類比合成器</a></li>
              <li><a class="dropdown-item" href="#">數位合成器</a></li>
              <li><a class="dropdown-item" href="#">複音合成器</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              品牌
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Korg</a></li>
              <li><a class="dropdown-item" href="#">Novation</a></li>
              <li><a class="dropdown-item" href="#">Waldorf</a></li>
            </ul>
          </li>

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