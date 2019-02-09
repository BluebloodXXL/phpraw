<?php
/**
 * Created by PhpStorm.
 * User: DenVa36
 * Date: 1/25/2019
 * Time: 10:51 PM
 */

include_once 'Connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE from emp_record WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if($result){
        echo '<script>window.open("read.php?Delete=Successful", "_self")</script>';
    } else {
        echo '<script>window.open("read.php?Delete=Unsuccessful", "_self")</script>';
    }
}


?>