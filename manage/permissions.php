<?php include "header.php" ?>
<script>
    function aidselect(a) {
        var x = a.options[a.selectedIndex].value;
        location.replace("permissions.php?aid=" + x);
    }
</script>
<?php
$aid = "";
if (isset($_POST['id'])) {
    $aid = $_POST['aid'];
    $sid = $_POST['sid'];
}
?>

<div class="col-lg-12">
    <div class="card alert">
        <div class="card-header">
            <h2>權限管理</h2><Br />
            <div class="row">

            </div>
        </div>

        <div class="card-body">
            <div class="horizontal-form">
                <form class="form-horizontal" method="post" action="admindetailu.php">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">管理者帳號：</label>
                        <div class="col-sm-10">
                            <?php
                            include '../Connections/conn_db.php';
                            $sql = "select * from admin order by aid asc";
                            $result = $link->query($sql)
                            ?>
                            <select size="1" name="aid" class="form-control" onchange="aidselect(this)">
                                <?php
                                while ($row = $result->fetch()) {
                                    echo "<option value=\"" . $row['aid'] . "\">" . $row['aid'] . " " . $row['aname'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">權限：</label>
                        <div class="col-sm-10">
                            <div class="checkbox icheck-primary">
                                <input type="checkbox" name="sid[]" />
                                <label for="someCheckboxId">Click to check</label>
                            </div>
                            <div class="checkbox icheck-primary">
                                <input type="checkbox" name="sid[]" />
                                <label for="someCheckboxId">Click to check</label>
                            </div>
                            <div class="checkbox icheck-primary">
                                <input type="checkbox" name="sid[]" />
                                <label for="someCheckboxId">Click to check</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary btn-flat btn-addon m-b-10 m-l-5"><i class="ti-check"></i>確認</button>
                            <a href="index.php"><button type="button" class="btn btn-default btn-flat btn-addon m-b-10 m-l-5"><i class="ti-close"></i>離開</button></a>
                        </div>

                    </div>
                    <div class="form-group">

                    </div>
                </form>
            </div>
        </div>

    </div>
</div><!-- /# column -->


<?php include "footer.php" ?>