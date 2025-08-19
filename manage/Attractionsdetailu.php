<?php include 'header.php';
include '../Connections/conn_db.php';
if (isset($_GET['p_id'])) {
    $id = $_GET['p_id'];
    $sql = "select * from product where p_id='$id'";
    $result = $link->query($sql);
    $row = $result->fetch();
    $p_id = $row['p_id'];
    $classid = $row['classid'];
    $p_name = $row['p_name'];
    $p_intro = $row['p_intro'];
    $p_price = $row['p_price'];
    $p_open = $row['p_open'];
    $p_content = $row['p_content'];
}
if (isset($_POST['p_id'])) {
    $id = $_POST['p_id'];
    $classid = $_POST['classid'];
    $p_name = $_POST['p_name'];
    $p_intro = $_POST['p_intro'];
    $p_price = $_POST['p_price'];
    $p_open = $_POST['p_open'];
    $p_content = $_POST['p_content'];
    $sql = "update product set classid='$classid',p_name='$p_name',p_intro='$p_intro',p_price=$p_price,p_open=$p_open,p_content='$p_content' where p_id=$id";
    if ($link->query($sql)) {
        if (!$_FILES['file']['error'][0] == 4) {
            print_r($_FILES['file']);
            $sql = "select img_id,img_file from product_img where p_id='$id'";
            $result = $link->query($sql);
            while ($row = $result->fetch()) {
                if (file_exists("../product_img/" . $row['img_file'])) {
                    unlink("../product_img/" . $row['img_file']);
                }
                $sql = "delete from product_img where img_id=" . $row['img_id'];
                $result2 = $link->query($sql);
            }

            $images = $_FILES['file']; // 獲取上傳的文件
            $filenames = $images['name']; // 文件名
            $filetmps = $images['tmp_name']; // 文件臨時路徑
            $zdx = 0;
            for ($i = 0; $i < count($filenames); $i++) { // 接收上傳的文件
                $zdx++;
                $ext = explode('.', basename($filenames[$i])); //将文件名按 “.” 分割成数组
                $target = $id . $zdx . "." . array_pop($ext); //$id+$zdx
                $sql = "insert into product_img(p_id,img_file,sort) values ($id,'$target',$zdx)";
                $link->query($sql);

                move_uploaded_file($filetmps[$i], "../product_img/" . $target); //tmp_name 為上傳檔案的臨時位置，將其移動到需要上傳的路径

            }
        }
        echo "<script>alert('修改成功');location.replace('Attractions.php')</script>";
    } else
        echo "<script>alert('修改失敗');</script>";
}
?>

<div class="col-lg-12">
    <div class="card alert">
        <div class="card-header">
            <h2>修改產品</h2><Br />
            <div class="row">


            </div>
        </div>

        <div class="card-body">
            <div class="horizontal-form">
                <form method="post" enctype="multipart/form-data" action="Attractionsdetailu.php" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">產品編號：</label>
                        <div class="col-sm-10">
                            <input type="text" name="p_id" class="form-control" value="<?= $id ?>" placeholder="產品編號" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">產品類別：</label>
                        <div class="col-sm-10">
                            <?php
                            include '../Connections/conn_db.php';
                            $sql = "select * from pyclass where level=2 order by classid asc";
                            $result = $link->query($sql);
                            ?>
                            <select size="1" name="classid" class="form-control">
                                <?php
                                while ($row = $result->fetch()) {
                                    ($classid = $row['classid']) ? $selected = "selected" : $selected = "";

                                    echo "<option value=\"" . $row['classid'] . "\" $selected>" . $row['classid'] . "." . $row['cname'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">產品名稱：</label>
                        <div class="col-sm-10">
                            <input type="text" name="p_name" value="<?= $p_name ?>" class="form-control" placeholder="產品名稱">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">產品介紹：</label>
                        <div class="col-sm-10">
                            <textarea name="p_intro" class="form-control" rows="5" cols="50" placeholder="產品介紹"><?= $p_intro ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">價格：</label>
                        <div class="col-sm-10">
                            <input type="text" name="p_price" value="<?= $p_price ?>" class="form-control" value="0" placeholder="請輸入價格">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">是否上架：</label>
                        <div class="col-sm-10">
                            <?php
                            $checked_0 = "";
                            $checked_1 = "";
                            if ($p_open == 0)
                                $checked_0 = "checked";
                            else
                                $checked_1 = "checked";
                            ?>
                            <input type="radio" value="0" name="p_open" <?= $checked_0 ?>>否
                            <input type="radio" value="1" name="p_open" <?= $checked_1 ?>>是
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">產品詳細規格：</label>
                        <div class="col-sm-10">
                            <textarea name="p_content" class="form-control" rows="8" cols="50" placeholder="產品詳細規格"><?= $p_content ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">產品圖片：</label>
                        <div class="col-sm-10">
                            <input type="file" class="file" id="file" name="file[]" multiple>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary btn-flat btn-addon m-b-10 m-l-5"><i class="ti-check"></i>確認</button>
                            <a href="Attractions.php"><button type="button" class="btn btn-default btn-flat btn-addon m-b-10 m-l-5"><i class="ti-close"></i>離開</button></a>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div><!-- /# column -->
    </body>
    <script>
        $("#file").fileinput({
            language: 'zh-TW', //語言設定
            //    uploadUrl: 'upload.php',  //上傳地址
            overwriteInitial: true,
            initialPreviewAsData: true,
            previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
            initialPreview: [
                <?php
                $sql = "select img_file from product_img where p_id=$id order by sort asc";
                $result = $link->query($sql);
                while ($row = $result->fetch()) {
                    echo "\"../product_img/" . $row['img_file'] . "\",\n";
                }
                ?>
            ],
            allowedFileExtensions: ['jpg', 'png', 'bmp', 'jpeg', 'webp'], //接收的文件后缀
            showUpload: false, //是否显示上传按钮
            showPreview: true, //預覽
            showCaption: true, //是否显示标题
            showRemove: false,

            dropZoneEnabled: false, //是否显示拖拽区域
            browseClass: "btn btn-primary", //按钮样式
            ////     uploadAsync: false,
            layoutTemplates: {
                actionDelete: '', //去除上传预览的缩略图中的删除图标
                actionUpload: '', //去除上传预览缩略图中的上传图片；
                //   actionZoom:''   //去除上传预览缩略图中的查看详情预览的缩略图标。
            }
        });
    </script>
    <?php include 'footer.php';
