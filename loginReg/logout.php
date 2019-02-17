<?php
include("functions/init.php");

    session_destroy();
    redirect("index.php");
    setcookie("email", '', time()-86000);

?>