<?php
/**
 * Created by PhpStorm.
 * User: DenVa36
 * Date: 1/24/2019
 * Time: 2:51 AM
 */

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud";

// create connection

$conn = new mysqli($servername, $username, $password, $dbname);

// check connection

if($conn->connect_error) {
    die ("Connection failed ".$conn->connect_error);
} else {
    //echo "Successfully Connected";
}

?>