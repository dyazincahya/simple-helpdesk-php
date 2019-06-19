<?php include('header.php');?>

<?php
    $user = Q_array("SELECT * FROM tbl_user WHERE tu_role='customer' ORDER BY tu_id DESC");
    $department = Q_array("SELECT * FROM tbl_department ORDER BY td_id DESC");
    $service = Q_array("SELECT * FROM tbl_service ORDER BY ts_id DESC");
    $priority = Q_array("SELECT * FROM tbl_priority ORDER BY tp_id DESC");
?>

<div class="container">
    <div class="page-header"><h1>New Ticket</h1></div>
    
    <form method="POST">
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="">User:</label>
                <select name="user" class="form-control">
                    <option value="">~ select user ~</option>
                    <?php foreach ($user as $key => $u) {
                        echo '<option value="'.$u['tu_id'].'">'.$u['tu_full_name'].' - '.$u['tu_email'].'</option>';
                    } ?>
                </select>
            </div>
            <div class="col-md-8 form-group">
                <label for="">Subject:</label>
                <input type="text" name="subject" class="form-control" required="true">
            </div>
            <div class="col-md-4 form-group">
                <label for="">Department:</label>
                <select name="department" class="form-control" required="true">
                    <option value="">~ select department ~</option>
                    <?php foreach ($department as $key => $u) {
                        echo '<option value="'.$u['td_id'].'">'.$u['td_name'].'</option>';
                    } ?>
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label for="">Service:</label>
                <select name="service" class="form-control" required="true">
                    <option value="">~ select service ~</option>
                    <?php foreach ($service as $key => $u) {
                        echo '<option value="'.$u['ts_id'].'">'.$u['ts_name'].'</option>';
                    } ?>
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label for="">Priority:</label>
                <select name="priority" class="form-control" required="true">
                    <option value="">~ select priority ~</option>
                    <?php foreach ($priority as $key => $u) {
                        echo '<option value="'.$u['tp_id'].'">'.$u['tp_name'].'</option>';
                    } ?>
                </select>
            </div>
            <div class="col-md-12 form-group">
                <label for="">Message:</label>
                <textarea name="message" class="form-control" rows="10"></textarea>
            </div>
        </div>
        <button type="submit" name="save" class="btn btn-primary btn-lg">Submit Ticket</button>
    </form>
</div>

<?php
    if(isset($_POST['save']))
    {
        $a = Q_mres($_POST['user']);
        $b = Q_mres($_POST['subject']);
        $c = Q_mres($_POST['department']);
        $d = Q_mres($_POST['service']);
        $e = Q_mres($_POST['priority']);
        $f = Q_mres($_POST['message']);

        $sql = "INSERT INTO tbl_ticket (tt_user, tt_subject, tt_department, tt_service, tt_priority, tt_message) VALUES ('$a', '$b', '$c', '$d', '$e', '$f')";
        if(Q_execute($sql)){
            redirect_to("ticket-list.php");
        }
    }
?>

<?php include('footer.php');?>