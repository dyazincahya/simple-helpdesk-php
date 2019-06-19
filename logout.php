<?php
    session_start();
    include("func.php");

    session_destroy();
    redirect_to(site_url(true));
?>