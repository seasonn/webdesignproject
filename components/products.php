<?php require_once('lib/php_lib.php'); ?>
<div class="container mt-5 mb-4">
    <div hidden>source:https://digilog.tw/</div>
    <div class="product">
        <?php
        //建立商品資料查詢
        $maxRows_rs = 4; //分頁產品數
        $pageNum_rs = 0; //起始頁
        if (isset($_GET['pageNum_rs'])) {
            $pageNum_rs = $_GET['pageNum_rs'];
        }
        $startRow_rs = $pageNum_rs * $maxRows_rs;

        if (isset($_GET['classid'])) {
            //使用產品類別查詢
            $queryFirst = sprintf("SELECT * FROM product, product_img WHERE p_open=1 AND product_img.sort=1 AND product.p_id=product_img.p_id AND product.classid='%d' ORDER BY product.p_id DESC", $_GET['classid']);
        } else {
            //列出所有產品
            $queryFirst = sprintf("SELECT * FROM product, product_img WHERE p_open=1 AND product_img.sort=1 AND product.p_id=product_img.p_id ORDER BY product.p_id DESC", $maxRows_rs);
        }

        $query = sprintf("%s LIMIT %d, %d", $queryFirst, $startRow_rs, $maxRows_rs);
        $pList01 = $conn->query($query);
        ?>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
            <?php
            while ($pList01_Rows = $pList01->fetch()) { ?>
                <div class="col">
                    <div class="card h-100 border-0">
                        <img src="./product_img/<?= $pList01_Rows['img_file']; ?>" class="card-img-top" alt="<?= $pList01_Rows['p_name']; ?>" title="<?= $pList01_Rows['p_name']; ?>">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <p class="card-title"><?= $pList01_Rows['p_name']; ?></p>
                            <p class="card-text">NT<?= $pList01_Rows['p_price']; ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="row mt-2">
            <?php
            if (isset($_GET['totalRows_rs'])) {
                $totalRows_rs = $GET['totalRows_rs'];
            } else {
                $all_rs = $conn->query($queryFirst);
                $totalRows_rs = $all_rs->rowCount();
            }
            $totalPage_rs = ceil($totalRows_rs / $maxRows_rs) - 1;
            $prev_rs = "&laquo;";
            $next_rs = "&raquo;";
            $seperator = "|";
            $max_links = "20";
            $pages_rs = buildNavigation($pageNum_rs, $totalPage_rs, $prev_rs, $next_rs, $seperator, $max_links, true, 3, "rs");
            ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?= $pages_rs[0] . $pages_rs[1] . $pages_rs[2]; ?>
                </ul>
            </nav>
        </div>

    </div>