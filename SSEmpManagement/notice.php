<?php
/**
 * Created by PhpStorm.
 * User: DenVa36
 * Date: 2/26/2019
 * Time: 3:50 PM
 */

//include ("functions/functions.php");
include ("functions/init.php");
if(logged_in())
    redirect("middleware.php");
elseif(logged_in_Admin())
    redirect("middleware.php");
else
    validate_user_login();
?>