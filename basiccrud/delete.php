<?php
/**
 * Created by PhpStorm.
 * User: DenVa36
 * Date: 1/25/2019
 * Time: 10:51 PM
 */

include_once 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE from companies WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if($result){
        echo "Successfully deleted.";
    } else {
        echo "Operation unsuccessful";
    }
}


?>