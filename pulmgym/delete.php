<?php
/**
 * Created by PhpStorm.
 * User: DenVa36
 * Date: 2/19/2019
 * Time: 6:46 AM
 */

include("includes/header.php");
include("includes/nav.php");

if(logged_in_Admin()) {

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $id = clean($_GET['id']);
        $id = escape($id);

        $sql = "DELETE from users WHERE id = '$id'";
        $result = query($sql);

        if ($result) {
            redirect("read.php");
        } else {
            redirect("read.php");
        }
    }
}
else
    redirect("index.php");

?>
