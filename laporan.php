<?php include('header.php');?>

<div class="container">
    <div class="page-header print-header"><h1>Laporan</h1></div>
    
    <?php if(!isset($_GET['hideformfilter'])) { ?>
        <form method="GET">
            <div class="row">
                <div class="col-md-3 form-group">
                    <label for="">Start date:</label>
                    <input type="date" name="start" class="form-control" required="true">
                </div>
                <div class="col-md-3 form-group">
                    <label for="">End date:</label>
                    <input type="date" name="end" class="form-control" required="true">
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Status:</label>
                    <select name="status" class="form-control">
                        <option value="ALL">- select status -</option>
                        <option value="NEW">NEW</option>
                        <option value="PROCCESS">PROCCESS</option>
                        <option value="PENDDING">PENDDING</option>
                        <option value="CANCEL">CANCEL</option>
                        <option value="DONE">DONE</option>
                    </select>
                </div>
                <input type="hidden" name="hideformfilter" value="true">
            </div>
            <input type="submit" name="filter" class="btn btn-primary" value="filter">
        </form>
    <?php } ?>

    <?php
        if(isset($_GET['filter']))
        {
            $q_status = "AND tt_status!='DELETE'";
            if(isset($_GET['status'])){
                if($_GET['status'] !== "ALL"){
                    $k_status = Q_mres($_GET['status']);
                    $q_status = "AND tt_status='$k_status'";
                }
            }

            $k_start = Q_mres($_GET['start']);
            $k_end = Q_mres($_GET['end']);

            $sql = "
                SELECT * FROM tbl_ticket a
                LEFT JOIN tbl_user b ON b.tu_id=a.tt_user
                LEFT JOIN tbl_department c ON c.td_id=a.tt_department
                LEFT JOIN tbl_service d ON d.ts_id=a.tt_service
                LEFT JOIN tbl_priority e ON e.tp_id=a.tt_priority
                WHERE (DATE_FORMAT(tt_created, '%Y-%m-%d') BETWEEN '$k_start' AND '$k_end') ". $q_status ." 
                ORDER BY tt_id DESC
            ";
            $data = Q_array($sql);
            $data_count = Q_count($sql);

            $re_start = date("d F Y", strtotime($_GET['start']));
            $re_end = date("d F Y", strtotime($_GET['end']));

            echo '<div class="print-container">';
            echo '<p>Berikut ini adalah daftar laporan tiket periode <b>'. $re_start .'</b> sampai <b>'. $re_end .'</b> terdapat <span class="label label-default">'. $data_count .' data</span></p>';

            echo '
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
                    </tr>
            ';
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
                    </tr>
                ";
            }
            echo '</table>';
            echo '</div>';
            echo '<button onclick="window.print()" class="btn btn-primary print-hide">Print Now</button> ';
            echo '<a href="'. site_url() .'/laporan.php" class="btn btn-default print-hide">Clear Filter</a> ';
        }
    ?>
</div>
<?php include('footer.php');?>