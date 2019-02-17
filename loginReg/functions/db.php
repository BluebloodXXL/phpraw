<?php
/**
 * Created by PhpStorm.
 * User: duke90
 * Date: 1/8/2019
 * Time: 3:47 AM
 */

$con = mysqli_connect('localhost', 'root', '', 'login_db');


function row_count($result){
    return mysqli_num_rows($result);
}

function escape($string) {
    global $con;
    return mysqli_real_escape_string($con, $string);
}

function query($sql){
    global $con;
    return mysqli_query($con, $sql);
}

function confirm($result){
    global $con;
    if(!$result){
        die("QUERY FAILED" . mysqli_error($con));
    }
}

function fetch_array($result){
    global $con;
    return mysqli_fetch_array($result);
}