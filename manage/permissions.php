<?php include "header.php"?>
<script>
    function aidselect(a) {
    var x = a.options[a.selectedIndex].value;
    location.replace("permissions.php?id="+x);
    }
</script>
<?php
$id="";
if (isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="select * from admin where aid = ?";
    $result=$link->prepare($sql);
    $aid[]=$id;
    $result->execute($aid);
    $row = $result->fetch(PDO::FETCH_ASSOC);   
}
if (isset($_POST['aid'])){
    $aid=$_POST['aid'];
    $sid=$_POST['sid'];
    include '../Connections/conn_db.php';
    $sql = "delete from mright where aid='$aid'";
    $result=$link->query($sql);   
   // print_r($sid);
    for ($i=0;$i<count($sid);$i++){
    $sql = "insert into mright values('$aid','".$sid[$i]."')";
    $result=$link->query($sql);    
    }
       echo "<script>alert('權限新增成功');</script>";      
}
?>

                    <div class="col-lg-12">
                        <div class="card alert">
                            <div class="card-header">
                                <h2>權限管理</h2><Br/>
                                 <div class="row">

                                </div>
                            </div>
                            
                            <div class="card-body">
                                <div class="horizontal-form">
                                    <form class="form-horizontal" method="post" action="permissions.php">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">管理者帳號：</label>
                                            <div class="col-sm-10">
                                                <?php
                                                include '../Connections/conn_db.php';
                                                $sql = "select * from admin order by aid asc";
                                                $result=$link->query($sql);
                                                ?>
                                                <select size="1" name="aid" class="form-control" onchange="aidselect(this)" >
                                                    <option value="">請選擇管理者</option>
                                                <?php 
                                                while ($row2=$result->fetch(PDO::FETCH_ASSOC)){
                                                    ($id==$row2['aid'])?$selected="selected":$selected="";
                                                    echo "<option value=\"".$row2['aid']."\" $selected>".$row2['aid']." ".$row2['aname']."</option>";
                                                }
                                                ?>               
                                               </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">權限：</label>
                                            <div class="col-sm-10">
                                                <?php 


                                                $sql = "select sid from mright where aid='$id'";
                                                $result3=$link->query($sql);
                                                $row5=array();
                                                while ($row3=$result3->fetch()){
                                                    $row5[]=$row3['sid'];
                                                 }
                                                $sql = "select * from programs order by sid asc";
                                                
                                                $result2=$link->query($sql);

                               //                 print_r($row5);
                                                while ($row2=$result2->fetch()){
                                                    (in_array($row2['sid'],$row5))?$checked="checked":$checked="";?>
                                                   <div class="checkbox icheck-primary">
                                                       <input type="checkbox" name="sid[]" <?=$checked?> value="<?=$row2['sid']?>"/>
                                                       <label for="someCheckboxId"><?=$row2['sname']?></label>
                                                   </div>
                                              <?php  }
                                                ?>  
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

						
 <?php include "footer.php"?>