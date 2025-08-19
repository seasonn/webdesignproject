<?php include 'header.php';
//search
$varSearch = "";
$varWhere = "";
if (isset($_GET['Search'])) {
    $varSearch = $_GET['Search'];
    if ($varSearch != "") {
        $varWhere = " where p.classid = $varSearch";
    }
}
//delete
if (isset($_GET['mode'])) {
    $mode = $_GET['mode'];

    if ($mode = "delete") {
        $id = $_GET['id'];
        require '../Connections/conn_db.php';
        $sql = "delete from product where p_id='$id'";
        $result = $link->query($sql);
        $sql = "select img_id,img_file from product_img where p_id='$id'";
        $result = $link->query($sql);
        while ($row = $result->fetch()) {

            if (file_exists("../product_img/" . $row['img_file'])) {
                unlink("../product_img/" . $row['img_file']);
            }

            $sql = "delete from product_img where img_id=" . $row['img_id'];
            $result2 = $link->query($sql);
        }
        echo "<script>alert('id為" . $id . "的資料已刪除');</script>";
    }
}
?>
<div class="col-lg-12">
    <div class="card alert">
        <div class="card-header">
            <h2>產品管理</h2><Br />
            <div class="row">
                <a href="Attractionsdetail.php"><button type="button" class="col-lg-2 btn btn-primary btn-flat btn-addon m-b-10 m-l-20"><i class="ti-plus"></i>新增產品 </button></a>
                <div class="basic-form col-lg-8">
                    <form>

                        <div class="form-group">

                            <div class="input-group input-group-default">
                                <?php
                                include '../Connections/conn_db.php';
                                $sql = "select * from pyclass where level=2 order by classid asc";
                                $result = $link->query($sql);
                                ?>
                                <select size="1" name="Search" class="form-control">
                                    <option value="">全部</option>
                                    <?php
                                    while ($row = $result->fetch()) {
                                        if ($row['classid'] == $varSearch)
                                            $selected = "selected";
                                        else
                                            $selected = "";
                                        echo "<option value=\"" . $row['classid'] . "\" $selected >" . $row['cname'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <span class="input-group-btn"><button class="btn btn-primary btn-group-right" type="submit"><i class="ti-search"></i> 查詢</button></span>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-responsive table-striped m-t-30">
                <thead>
                    <tr style="border-top:1px solid #e7e7e7;">
                        <th>產品編號</th>
                        <th>產品簡稱</th>
                        <th>產品敘述</th>
                        <th>產品圖片</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $records_per_page = 3;  // 每一頁顯示的記錄筆數
                    $rc = 0;

                    //      echo "SELECT * FROM product".$varWhere;

                    if (isset($_GET['page'])) //目前頁數
                    {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }

                    $sql = "SELECT count(*) as rowcount from product as p" . $varWhere;

                    $r = $link->query($sql);
                    $rw = $r->fetch();
                    $total_records = $rw['rowcount'];
                    $offset = ($page - 1) * $records_per_page; //指標偏移數  
                    $total_pages = ceil($total_records / $records_per_page);

                    $sql = "SELECT p.p_id,c.cname,p.p_name,p.classid FROM product as p left join pyclass as c  on p.classid=c.classid  $varWhere order by p_id LIMIT $offset, $records_per_page";
                    //   echo $sql;
                    $result = $link->query($sql);

                    while ($rc < $records_per_page and $row = $result->fetch()) {
                        $sql = "SELECT  img_file from product_img where p_id=" . $row['p_id'];
                        //    echo $sql;
                        $imgfile = "";
                        if ($r = $link->query($sql)) {
                            if ($rw = $r->fetch())
                                $imgfile = $rw['img_file'];
                        }
                        echo "<tr>";
                        echo "    <th scope=\"row\">" . $row['p_id'] . "</th>";
                        echo "    <td>" . $row['cname'] . "</td>";
                        echo "    <td>" . $row['p_name'] . "</td>";
                        echo "    <td>" . "<img src=\"../product_img/$imgfile\" width=100 height=100>";
                        echo "   <td><a href=\"Attractionsdetailu.php?p_id=" . $row['p_id'] . "\"><button type=\"button\" class=\"btn btn btn-info btn btn-flat btn-addon btn-sm m-b-5 m-l-5\"> 
                                            <i class=\"ti-pencil-alt\"></i>修改</button></a><button type=\"button\" onclick=\"javascript:deleteConfirm('Attractions.php', '" . $row['p_id'] . "')\" class=\"btn btn btn-default btn btn-flat btn-addon btn-sm m-b-5 m-l-5\">
                                            <i class=\"ti-trash\"></i>刪除</button></td>";
                        echo "</tr>";
                        $rc = $rc + 1;
                    } ?>
                    <?php
                    echo "<tr>\n";
                    echo "<td colspan=5>\n";
                    if ($page > 1)  // 顯示上一頁
                    {
                        echo "<a href='Attractions.php?page=" . ($page - 1) . "&Search=" . $varSearch .
                            "' style=\"color: #000\">上一頁</a>| ";
                    }
                    for ($i = 1; $i <= $total_pages; $i++)
                        if ($i != $page)
                            echo "<a href=\"Attractions.php?page=" . $i . "&Search=" . $varSearch . "\" style=\"color: #000\";>" .
                                $i . "</a>\n ";
                        else
                            echo $i . " ";
                    if ($page < $total_pages) {   // 顯示下一頁
                        echo "|<a href='Attractions.php?page=" . ($page + 1) . "&Search=" . $varSearch .
                            "' style=\"color: #000\">下一頁</a> ";
                    }
                    echo "</td>\n";
                    echo "</tr>"    ?>
                </tbody>
            </table>
        </div>



    </div>
</div><!-- /# column -->

<?php include 'footer.php'; ?>