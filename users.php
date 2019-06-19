<?php include('header.php');?>

<div class="container">
    <div class="page-header"><h1>Data Users</h1></div>
    
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">Create New</button>
    <div id="create" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form class="modal-content" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">New User</h4>
                </div>
                <div class="modal-body">                    
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">Full Name:</label>
                            <input type="text" name="fullname" class="form-control" required="true">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="">Email:</label>
                            <input type="text" name="email" class="form-control" required="true">
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
                    <td>FULL NAME</td>
                    <td>EMAIL</td>
                    <td>ACTION</td>
                </tr>
                <?php 
                    $data = Q_array("SELECT * FROM tbl_user WHERE tu_role='customer' ORDER BY tu_id DESC");
                    foreach ($data as $key => $val) {
                        echo "
                            <tr>
                                <td>".($key+1)."</td>
                                <td>".$val['tu_full_name']."</td>
                                <td>".$val['tu_email']."</td>
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
                                    <h4 class="modal-title">Edit <?=$val['tu_full_name'];?></h4>
                                </div>
                                <div class="modal-body">                    
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label for="">Full Name:</label>
                                            <input type="text" name="fullname" class="form-control" required="true" value="<?=$val['tu_full_name'];?>">
                                            <input type="hidden" name="id" value="<?=$val['tu_id'];?>">
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="">Email:</label>
                                            <input type="text" name="email" class="form-control" required="true" value="<?=$val['tu_email'];?>">
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
        $a = Q_mres('customer');
        $d = Q_mres($_POST['fullname']);
        $e = Q_mres($_POST['email']);

        $sql = "INSERT INTO tbl_user (tu_role, tu_full_name, tu_email) VALUES ('$a', '$d', '$e')";
        if(Q_execute($sql)){
            redirect_to("users.php");
        }
    }

    if(isset($_POST['update']))
    {
        $a = Q_mres('customer');
        $d = Q_mres($_POST['fullname']);
        $e = Q_mres($_POST['email']);
        $f = Q_mres($_POST['id']);

        $sql = "UPDATE tbl_user SET tu_role='$a', tu_full_name='$d', tu_email='$e' WHERE tu_id='$f'";
        if(Q_execute($sql)){
            redirect_to("users.php");
        }
    }

    if(isset($_POST['delete']))
    {
        $a = Q_mres($_POST['id']);

        $sql = "DELETE FROM tbl_user WHERE tu_id='$a'";
        if(Q_execute($sql)){
            redirect_to("users.php");
        }
    }
?>

<?php include('footer.php');?>