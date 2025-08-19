<?php include "header.php"?>
<?php
$aid="";
$aname="";
$passwd="";
if (isset($_POST['aid'])){
    $aid=$_POST['aid'];
    $aname=$_POST['aname'];
    $passwd=$_POST['passwd'];
    $sql="select * from admin where aid='$aid'";
     
    $result=$link->query($sql);   
    if ($row = $result->fetch()){
        echo "<script>alert('管理者帳號已存在,無法新增')</script>";
    }
    else
    {
        $sql="insert into admin values('$aid','$aname','$passwd')";
        $result=$link->query($sql);   
        if ($result){
           echo "<script>alert('新增成功')</script>";
           }
        else
           echo "<script>alert('新增失敗')</script>";
    }
}
?>

                    <div class="col-lg-12">
                        <div class="card alert">
                            <div class="card-header">
                                <h2>新增管理者</h2><Br/>
                                 <div class="row">
                                
                                
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <div class="horizontal-form">
                                    <form class="form-horizontal" method="post" action="admindetail.php">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">管理者帳號：</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="aid" value="<?=$aid?>"class="form-control" placeholder="管理者帳號">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">管理者名稱：</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="aname" value="<?=$aname?>" class="form-control" placeholder="管理者名稱">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">密碼：</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="passwd" value="<?=$passwd?>" class="form-control" placeholder="密碼">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary btn-flat btn-addon m-b-10 m-l-5"><i class="ti-check"></i>確認</button>
                                                 <a href="admin.php" ><button type="button" class="btn btn-default btn-flat btn-addon m-b-10 m-l-5"><i class="ti-close"></i>離開</button></a>
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