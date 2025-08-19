<?php include "header.php" ?>
<?php
//Search
$varSearch = "";
$varWhere = "";

if (isset($_GET['Search'])) {
    $varSearch = $_GET['Search'];
    if ($varSearch != "") {
        $varWhere = " where sid ='$varSearch' or sname like '%$varSearch%'";
    }
}

if (isset($_GET['mode'])) {
    $mode = $_GET['mode'];
    switch ($mode) {
        case "delete":
            $id = $_GET['id'];
            $sql = "delete from programs where sid='$id'";
            if ($result = $link->query($sql)) {
                echo "<script>redirectDialog('program.php','ID: $id 的資料已刪除!');</script>";
            }
            break;
    }
}
?>
<div class="col-lg-12">
    <div class="card alert">
        <div class="card-header">
            <h2>程式資料管理</h2><Br />
            <div class="row">
                <a href="programdetail.php"><button type="button" class="col-lg-2 btn btn-primary btn-flat btn-addon m-b-10 m-l-20"><i class="ti-plus"></i>新增程式 </button></a>
                <div class="basic-form col-lg-8">
                    <form method="get" action="program.php">

                        <div class="form-group">

                            <div class="input-group input-group-default">
                                <input type="text" placeholder="Search Round" name="Search" class="form-control">
                                <span class="input-group-btn"><button class="btn btn-primary btn-group-right" type="submit"><i class="ti-search"></i> 查詢</button></span>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-responsive table-striped m-t-30">
                <?php
                //   include "db_open.php";

                $sql = "SELECT count(*) as rowcount from programs as a" . $varWhere;
                $r = $link->query($sql);
                $rw = $r->fetch();
                $total_records = $rw['rowcount'];

                isset($_GET['page']) ? $page = $_GET['page'] : $page = 1;


                $records_per_page = 3;

                $total_pages = ceil($total_records / $records_per_page);

                $offset = ($page - 1) * $records_per_page;

                $sql = "select * from programs" . $varWhere . " LIMIT $offset, $records_per_page";
                $result = $link->query($sql);
                ?>
                <thead>
                    <tr style="border-top:1px solid #e7e7e7;">
                        <th>程式編號</th>
                        <th>程式名稱</th>
                        <th>程式檔名</th>
                        <th>資料筆數:<?= $total_records ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $j = 1;
                    while ($row = $result->fetch() and $j <= $records_per_page) {
                    ?>
                        <tr>
                            <th scope="row"><?= $row['sid'] ?></th>
                            <td><?= $row['sname'] ?></td>
                            <td><?= $row['program'] ?></td>

                            <td><a href="programdetailu.php?id=<?= $row['sid'] ?>"><button type="button" class="btn btn btn-info btn btn-flat btn-addon btn-sm m-b-5 m-l-5"><i class="ti-pencil-alt"></i>修改</button></a>
                                <button type="button" onclick="deleteConfirm('program.php','<?= $row['sid'] ?>')" class="btn btn btn-default btn btn-flat btn-addon btn-sm m-b-5 m-l-5"><i class="ti-trash"></i>刪除</button>
                            </td>
                        </tr>
                    <?php
                        $j++;
                    }
                    ?>

                    </tr>
                    <tr>
                        <td colspan=4>
                            <?php if ($page > 1) { ?>
                                <a href="program.php?page=<?= ($page - 1) ?>&Search=<?= $varSearch ?>" style="color:#000">上一頁|</a>
                            <?php } ?>
                            <?php
                            for ($i = 1; $i <= $total_pages; $i++) {
                                if ($page != $i) { ?>
                                    <a href="program.php?page=<?= $i ?>&Search=<?= $varSearch ?>" style="color:#000"><?= $i ?></a>
                            <?php
                                } else
                                    echo $i;
                            }
                            ?>
                            <?php if ($page < $total_pages) { ?>
                                <a href="program.php?page=<?= ($page + 1) ?>&Search=<?= $varSearch ?>" style="color:#000">|下一頁</a>
                            <?php } ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>



    </div>
</div><!-- /# column -->
<?php include "footer.php" ?>