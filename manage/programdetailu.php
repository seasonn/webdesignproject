<?php include "header.php"?>
<?php
if (isset($_GET['id'])){
    $sid=$_GET['id'];
    $sql="select * from programs where sid='$sid'";
    $result=$link->query($sql); 
    $row = $result->fetch();}
else
{
    $sid=$_POST['sid'];
    $sname=$_POST['sname'];
    $program=$_POST['program'];
    $sql ="update programs set sname='$sname',program='$program' where sid='$sid'";
    if ($result=$link->query($sql))
    {
        echo "<script>redirectDialog('program.php','資料修改成功');</script>";
    } 
}
?>

                    <div class="col-lg-12">
                        <div class="card alert">
                            <div class="card-header">
                                <h2>程式修改</h2><Br/>
                                 <div class="row">

                                </div>
                            </div>
                            
                            <div class="card-body">
                                <div class="horizontal-form">
                                    <form class="form-horizontal" method="post" action="programdetailu.php">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">程式編號：</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="sid" value="<?=$sid?>"class="form-control" placeholder="程式帳號" readonly=readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">程式名稱：</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="sname" value="<?=$row['sname']?>" class="form-control" placeholder="程式名稱">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">程式檔名：</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="program" value="<?=$row['program']?>" class="form-control" placeholder="密碼">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary btn-flat btn-addon m-b-10 m-l-5"><i class="ti-check"></i>確認</button>
                                                <a href="program.php"><button type="button" class="btn btn-default btn-flat btn-addon m-b-10 m-l-5"><i class="ti-close"></i>離開</button></a>
                                            </div>
                    
                                        </div>
                                        <div class="form-group">
                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                     </div><!-- /# column -->					

						
 <?php include "footer.php"?>