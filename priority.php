<?php include('header.php');?>

<div class="container">
    <div class="page-header"><h1>Data Priority</h1></div>
    
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">Create New</button>
    <div id="create" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form class="modal-content" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">New Priority</h4>
                </div>
                <div class="modal-body">                    
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control" required="true">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="save" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <tr style="font-weight:bold;">
                    <td>NO</td>
                    <td>NAME</td>
                    <td>ACTION</td>
                </tr>
                <?php 
                    $data = Q_array("SELECT * FROM tbl_priority ORDER BY tp_id DESC");
                    foreach ($data as $key => $val) {
                        echo "
                            <tr>
                                <td>".($key+1)."</td>
                                <td>".$val['tp_name']."</td>
                                <td>
                                    <a class='btn btn-default' data-toggle='modal' data-target='#ed-".$key."'>Edit/Delete</a>
                                </td>
                            </tr>
                        ";
                ?>
                    <div id="ed-<?=$key;?>" class="modal fade" role="dialog">
                        <div class="modal-dialog" style="background-color:#FFFFFF;">
                            <form class="modal-content" method="POST">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Edit <?=$val['tp_name'];?></h4>
                                </div>
                                <div class="modal-body">                    
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label for="">Name</label>
                                            <input type="text" name="name" class="form-control" required="true" value="<?=$val['tp_name'];?>">
                                            <input type="hidden" name="id" value="<?=$val['tp_id'];?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="update" class="btn btn-default">Save Change</button>
                                    <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </table>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['save']))
    {
        $a = Q_mres($_POST['name']);

        $sql = "INSERT INTO tbl_priority (tp_name) VALUES ('$a')";
        if(Q_execute($sql)){
            redirect_to("priority.php");
        }
    }

    if(isset($_POST['update']))
    {
        $a = Q_mres($_POST['name']);
        $c = Q_mres($_POST['id']);

        $sql = "UPDATE tbl_priority SET tp_name='$a' WHERE tp_id='$c'";
        if(Q_execute($sql)){
            redirect_to("priority.php");
        }
    }

    if(isset($_POST['delete']))
    {
        $a = Q_mres($_POST['id']);

        $sql = "DELETE FROM tbl_priority WHERE tp_id='$a'";
        if(Q_execute($sql)){
            redirect_to("priority.php");
        }
    }
?>

<?php include('footer.php');?>