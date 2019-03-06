<?php
include ("functions/init.php");


if(logged_in()) {
    $email = $_SESSION['email'];
    $sql = "select r_oll from users where email = '$email'";
    $result = query($sql);

    if (row_count($result) == 1) {
        $row = fetch_array($result);
        if ($row['r_oll'] != 9) {
            $_SESSION['users'] = $row['r_oll'];
            redirect("users.php");
        } else {
            $_SESSION['admin'] = $row['r_oll'];
            redirect("admin.php");
        }
    }

}
else
    redirect("index.php");


