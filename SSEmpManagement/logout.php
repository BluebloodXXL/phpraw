<?php
include("functions/init.php");
include("functions/globals.php");

    //global $save_roll;

    //$save_roll = 0;
    session_destroy();
    redirect("index.php");
    setcookie("email", '', time()-86000);
    setcookie("admin", '', time()-86000);

?>