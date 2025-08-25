<div class="goods">
    <div class="container">
        <div class="card border-0 m-3">
            <div class="row g-0">
                <div class="col-md-5">
                    <?php
                    $SQLstring = sprintf("SELECT * FROM product_img WHERE product_img.p_id=%d ORDER BY sort", $_GET['p_id']);
                    $img_rs = $conn->query($SQLstring);
                    $imgList = $img_rs->fetch();
                    ?>
                    <img id="showGoods" name="showGoods" src="product_img/<?= $imgList['img_file']; ?>" class="img-fluid rounded-start" alt="<?= $data['p_name']; ?>" title="<?= $data['p_name']; ?>">
                    <div class="row mt-2">
                        <?php do { ?>
                            <div class="col-4"><a href="product_img/<?= $imgList['img_file']; ?>" rel="group" class="fancybox" title="<?= $data['p_name']; ?>"><img src="product_img/<?= $imgList['img_file']; ?>" class="img-fluid" alt="<?= $data['p_name'] ?>" title="<?= $data['p_name'] ?>" class="img-fluid"></a></div>
                        <?php } while ($imgList = $img_rs->fetch()); ?>

                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <h5 class="card-title"><?= $data['p_name']; ?></h5>
                        <p class="card-text"><?= $data['p_intro']; ?></p>
                        <h4 class="fw-bold"><?= $data['p_price']; ?> NTD</h4>
                        <div class="mt-3">
                            <div class="input-group p-0 shadow shadow-sm" style="max-width: 300px !important;">
                                <span class="input-group-text" id="inputGroup">數量</span>
                                <input type="number" min="0" name="qty" id="qty" value="1" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup">
                                <button name="button01" id="button01" type="button" class="btn btn-outline-dark" onclick="addcart(<?= $data['p_id']; ?>)">加入購物車</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-3">
            <?= $data['p_content']; ?>
        </div>
    </div>
</div>