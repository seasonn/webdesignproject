<?php include 'header.php';
if (isset($_POST['classid'])) {
    //接受使用者畫面欄位
    // $id = $_POST['p_id'];
    $classid = $_POST['classid'];
    $p_name = $_POST['p_name'];
    $p_intro = $_POST['p_intro'];
    $p_price = $_POST['p_price'];
    $p_open = $_POST['p_open'];
    $p_content = $_POST['p_content'];

    //將資料寫入product資料表
    include '../Connections/conn_db.php';
    $sql = "insert into product(classid,p_name,p_intro,p_price,p_open,p_content) values ($classid,'$p_name','$p_intro',$p_price,$p_open,'$p_content')";
    if ($conn->query($sql)) {
        if (!empty($_FILES['file'])) {
            $id = $conn->lastInsertId();
            $images = $_FILES['file']; // 獲取上傳的文件
            $filenames = $images['name']; // 文件名
            $filetmps = $images['tmp_name']; // 文件臨時路徑
        }
        $zdx = 0;
        for ($i = 0; $i < count($filenames); $i++) { // 接收上傳的文件
            $zdx++;
            $ext = explode('.', basename($filenames[$i])); //将文件名按 “.” 分割成数组
            $target = $id . $zdx . "." . array_pop($ext); //$id+$zdx
            $sql = "insert into product_img(p_id,img_file,sort) values ($id,'$target',$zdx)";
            
            $conn->query($sql);

            move_uploaded_file($filetmps[$i], "../product_img/" . $target); //tmp_name 為上傳檔案的臨時位置，將其移動到需要上傳的路径

        }

        echo "<script>alert('新增成功');</script>";
    } else
        echo "<script>alert('新增失敗');</script>";
}
?>

<div class="col-lg-12">
    <div class="card alert">
        <div class="card-header">
            <h2>新增產品</h2><Br />
            <div class="row">


            </div>
        </div>

        <div class="card-body">
            <div class="horizontal-form">
                <form method="post" enctype="multipart/form-data" action="Attractionsdetail.php" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">產品類別：</label>
                        <div class="col-sm-10">
                            <?php
                            include '../Connections/conn_db.php';
                            $sql = "select * from pyclass where level=2 order by classid asc";
                            $result = $conn->query($sql)
                            ?>
                            <select size="1" name="classid" class="form-control">
                                <?php
                                while ($row = $result->fetch()) {
                                    echo "<option value=\"" . $row['classid'] . "\">" . $row['classid'] . "." . $row['cname'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">產品名稱：</label>
                        <div class="col-sm-10">
                            <input type="text" name="p_name" class="form-control" placeholder="產品名稱">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">產品介紹：</label>
                        <div class="col-sm-10">
                            <textarea name="p_intro" class="form-control" rows="5" cols="50" placeholder="產品介紹"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">價格：</label>
                        <div class="col-sm-10">
                            <input type="text" name="p_price" class="form-control" value="0" placeholder="請輸入價格">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">是否上架：</label>
                        <div class="col-sm-10">
                            <input type="radio" value="0" name="p_open">否
                            <input type="radio" value="1" name="p_open" checked>是
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">產品詳細規格：</label>
                        <div class="col-sm-10">
                            <textarea name="p_content" class="form-control" rows="3" cols="50" placeholder="產品詳細規格"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">產品圖片：</label>
                        <div class="col-sm-10 container kv-main">
                            <input id="file" class="file" multiple type="file" name="file[]"> <!-- 初始化插件 -->
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

    </div>
</div><!-- /# column -->
<script>
    $("#file").fileinput({
        language: 'zh-TW', //語言設定
        //    uploadUrl: 'upload.php',  //上傳地址
        allowedFileExtensions: ['jpg', 'png', 'bmp', 'jpeg', 'webp'], //接收的文件后缀
        showUpload: false, //是否显示上传按钮
        showPreview: true, //預覽
        showCaption: true, //是否显示标题
        showRemove: true,

        dropZoneEnabled: false, //是否显示拖拽区域
        browseClass: "btn btn-primary", //按钮样式
        ////     uploadAsync: false,
        layoutTemplates: {
            // actionDelete:'', //去除上传预览的缩略图中的删除图标
            actionUpload: '', //去除上传预览缩略图中的上传图片；
            //   actionZoom:''   //去除上传预览缩略图中的查看详情预览的缩略图标。
        }
    });
</script>

<?php include 'footer.php';
