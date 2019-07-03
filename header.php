<?php 
    session_start();
    require_once("func.php"); 
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>HELPDESK</title>
    <link rel="shortcut icon" href="images/icon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.12.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <style type="text/css" media="print">
        @page 
        {
            size: auto;   /* auto is the current printer page size */
            margin: 0mm;  /* this affects the margin in the printer settings */
        }
        .print-hide{ display: none; }
        .print-header{ font-size: 15px; }
        .print-container{ font-size: 10px; }
    </style>
</head>

<?php 
    // if (session_status() !== PHP_SESSION_ACTIVE) {
    if(!session_me()){
        if(your_position() !== site_url(true)){
            redirect_to(site_url(true));
        }
        echo "
            <script>
                $(window).load(function(){        
                    $('#myModal').modal('show');
                }); 
            </script>
        ";
    }
?>

<body>
    <nav class="navbar navbar-inverse">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=site_url();?>">HELPDESK</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?=site_url();?>">Home <span class="sr-only">(current)</span></a></li>

                    <?php if(session_me()){ ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Data <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                            <li><a href="<?=site_url();?>/department.php">Department</a></li>
                            <li><a href="<?=site_url();?>/priority.php">Priority</a></li>
                            <li><a href="<?=site_url();?>/service.php">Service</a></li>
                            <li><a href="<?=site_url();?>/users.php">Users</a></li>
                            </ul>
                        </li>
                        <li><a href="<?=site_url();?>/ticket-list.php">List Ticket</a></li>
                        <li><a href="<?=site_url();?>/open-ticket.php">Open Ticket</a></li>
                        <li><a href="<?=site_url();?>/laporan.php">Laporan</a></li>
                    <?php } ?>
                </ul>
                
                <ul class="nav navbar-nav">
                    
                </ul>

                <?php 
                    if(!session_me()){
                        echo '<button type="button" class="btn btn-default navbar-btn navbar-right" data-toggle="modal" data-target="#myModal">Login</button>';
                    } else {
                        echo '<a href="'.site_url().'/logout.php" class="btn btn-default navbar-btn navbar-right">Logout</a>';
                    }
                ?>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>