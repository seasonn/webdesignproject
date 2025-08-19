<?php include "header.php"?>
<?php
if (isset($_GET['id'])){
    $aid=$_GET['id'];
    $sql="select * from admin where aid='$aid'";
    $result=$link->query($sql); 
    $row = $result->fetch();}
else
{
    $aid=$_POST['aid'];
    $aname=$_POST['aname'];
    $passwd=$_POST['passwd'];
    $sql ="update admin set aname='$aname',passwd='$passwd' where aid='$aid'";
    if ($result=$link->query($sql))
    {
        echo "<script>redirectDialog('admin.php','資料修改成功');</script>";
    } 
}
?>

                    <div class="col-lg-12">
                        <div class="card alert">
                            <div class="card-header">
                                <h2>管理者修改</h2><Br/>
                                 <div class="row">

                                </div>
                            </div>
                            
                            <div class="card-body">
                                <div class="horizontal-form">
                                    <form class="form-horizontal" method="post" action="admindetailu.php">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">管理者帳號：</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="aid" value="<?=$aid?>"class="form-control" placeholder="管理者帳號" readonly=readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">管理者名稱：</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="aname" value="<?=$row['aname']?>" class="form-control" placeholder="管理者名稱">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">密碼：</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="passwd" value="<?=$row['passwd']?>" class="form-control" placeholder="密碼">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary btn-flat btn-addon m-b-10 m-l-5"><i class="ti-check"></i>確認</button>
                                                <a href="admin.php"><button type="button" class="btn btn-default btn-flat btn-addon m-b-10 m-l-5"><i class="ti-close"></i>離開</button></a>
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