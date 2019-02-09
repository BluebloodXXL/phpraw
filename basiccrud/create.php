<?php
/**
 * Created by PhpStorm.
 * User: DenVa36
 * Date: 1/24/2019
 * Time: 3:23 AM
 */

include_once 'config.php';

if (isset($_POST['submit'])) {

    $name = $_POST['name'];

    if (empty($name)) {
        echo "Name is required";
    }
    else {

        $sql = "insert into companies (name) values ('$name')";
        $inserted_data = mysqli_query($conn, $sql);

        if ($inserted_data) {
            echo "$name " . "is saved.";
        } else {
            echo "$name " . "is not saved.";
        }
    }
}
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>
        PhpMysql CRUD
    </title>
</head>


<body>

<div class="center" style="text-align: center;">

    <h1>Create Data</h1>

    <form action="create.php" method="POST">
        <input type="text" name="name" placeholder="Enter Company Name">
        </br></br>
        <input type="submit" name="submit" value="Create">
    </form>

</div>

</body>
</html>
