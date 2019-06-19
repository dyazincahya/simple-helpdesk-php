<?php include('header.php');?>

<div class="container">
    <div class="page-header"><h1>Ticket List</h1></div>
    
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <tr style="font-weight:bold;">
                    <td>NO</td>
                    <td>FULL NAME</td>
                    <td>SUBJECT</td>
                    <td>SERVICE</td>
                    <td>DEPARTMENT</td>
                    <td>PRIORITY</td>
                    <td>STATUS</td>
                    <td>TIME</td>
                    <td>ACTION</td>
                </tr>
                <?php 
                    $sql = "
                        SELECT * FROM tbl_ticket a 
                        LEFT JOIN tbl_user b ON b.tu_id=a.tt_user
                        LEFT JOIN tbl_department c ON c.td_id=a.tt_department
                        LEFT JOIN tbl_service d ON d.ts_id=a.tt_service
                        LEFT JOIN tbl_priority e ON e.tp_id=a.tt_priority
                        WHERE tt_status!='DELETE'
                        ORDER BY tt_id DESC
                    ";
                    $data = Q_array($sql);
                    foreach ($data as $key => $val) {
                        echo "
                            <tr>
                                <td>".($key+1)."</td>
                                <td>".$val['tu_full_name']." <br> ".$val['tu_email']."</td>
                                <td>".$val['tt_subject']."</td>
                                <td>".$val['ts_name']."</td>
                                <td>".$val['td_name']."</td>
                                <td>".$val['tp_name']."</td>
                                <td>".$val['tt_status']."</td>
                                <td>".date("d F Y", strtotime($val['tt_created']))."<br>".date("H:i:s A", strtotime($val['tt_created']))."</td>
                                <td>
                                    <a class='btn btn-default' data-toggle='modal' data-target='#ed-".$key."'>Option</a>
                                </td>
                            </tr>
                        ";
                ?>
                    <div id="ed-<?=$key;?>" class="modal fade" role="dialog">
                        <div class="modal-dialog" style="background-color:#FFFFFF;">
                            <form class="modal-content" method="POST">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Change status <?=$val['tt_subject'];?></h4>
                                </div>
                                <div class="modal-body">                    
                                    <div class="row">
                                        <div class="col-md-8 form-group">
                                            <label for="">Status:</label>
                                            <select name="status" class="form-control" required="true">
                                                <option value="<?=$val['tt_status'];?>">SELECTED : <?=$val['tt_status'];?></option>
                                                <option value="NEW">NEW</option>
                                                <option value="PROCCESS">PROCCESS</option>
                                                <option value="PENDDING">PENDDING</option>
                                                <option value="CANCEL">CANCEL</option>
                                                <option value="DONE">DONE</option>
                                                <option value="DELETE">DELETE</option>
                                            </select>
                                            <input type="hidden" name="id" value="<?=$val['tt_id'];?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="update" class="btn btn-primary">Update</button>
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
    if(isset($_POST['update']))
    {
        $a = Q_mres($_POST['status']);
        $b = Q_mres($_POST['id']);

        $sql = "UPDATE tbl_ticket SET tt_status='$a' WHERE tt_id='$b'";
        if(Q_execute($sql)){
            redirect_to("ticket-list.php");
        }
    }
?>
<?php include('footer.php');?>