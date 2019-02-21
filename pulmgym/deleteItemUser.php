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

    if (isset($_GET['itemid']) && isset($_GET['id'])) {
        $id = $_GET['id'];
        $itemid = $_GET['itemid'];

        $id = clean($_GET['id']);
        $id = escape($id);

        $itemid = clean($_GET['itemid']);
        $itemid = escape($itemid);

        $sql = "DELETE from users_items WHERE (idUsers = '$id' AND idItems = '$itemid')";
        $result = query($sql);

        if ($result) {
            redirect("user.php?id=$id");
        } else {
            redirect("user.php?id=$id");
        }
    }
}
elseif (logged_in()){
    if (isset($_SESSION['id']) && isset($_GET['itemid'])) {
        $id = $_SESSION['id'];
        $itemid = $_GET['itemid'];


        $itemid = clean($_GET['itemid']);
        $itemid = escape($itemid);


        $sql = "DELETE from users_items WHERE (idUsers = '$id' AND idItems = '$itemid')";
        $result = query($sql);

        if ($result) {
            redirect("user.php");
        } else {
            redirect("user.php");
        }
    }
}
else
    redirect("index.php");

?>
