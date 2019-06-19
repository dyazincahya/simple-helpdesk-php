<?php include('header.php');?>

<div class="container">
    <div class="page-header"><h1>Data Service</h1></div>
    
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">Create New</button>
    <div id="create" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form class="modal-content" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">New Service</h4>
                </div>
                <div class="modal-body">                    
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control" required="true">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="">Description:</label>
                            <textarea class="form-control" name="description"></textarea>
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
                    <td>DESCRIPTION</td>
                    <td>ACTION</td>
                </tr>
                <?php 
                    $data = Q_array("SELECT * FROM tbl_service ORDER BY ts_id DESC");
                    foreach ($data as $key => $val) {
                        echo "
                            <tr>
                                <td>".($key+1)."</td>
                                <td>".$val['ts_name']."</td>
                                <td>".$val['ts_description']."</td>
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
                                    <h4 class="modal-title">Edit <?=$val['ts_name'];?></h4>
                                </div>
                                <div class="modal-body">                    
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label for="">Name</label>
                                            <input type="text" name="name" class="form-control" required="true" value="<?=$val['ts_name'];?>">
                                            <input type="hidden" name="id" value="<?=$val['ts_id'];?>">
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="">Description:</label>
                                            <textarea class="form-control" name="description"><?=$val['ts_description'];?></textarea>
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
        $b = Q_mres($_POST['description']);

        $sql = "INSERT INTO tbl_service (ts_name, ts_description) VALUES ('$a', '$b')";
        if(Q_execute($sql)){
            redirect_to("service.php");
        }
    }

    if(isset($_POST['update']))
    {
        $a = Q_mres($_POST['name']);
        $b = Q_mres($_POST['description']);
        $c = Q_mres($_POST['id']);

        $sql = "UPDATE tbl_service SET ts_name='$a', ts_description='$b' WHERE ts_id='$c'";
        if(Q_execute($sql)){
            redirect_to("service.php");
        }
    }

    if(isset($_POST['delete']))
    {
        $a = Q_mres($_POST['id']);

        $sql = "DELETE FROM tbl_service WHERE ts_id='$a'";
        if(Q_execute($sql)){
            redirect_to("service.php");
        }
    }
?>

<?php include('footer.php');?>