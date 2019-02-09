<?php
include_once "Connection.php";

if (isset($_POST["submit"])) {

    $ename = $_POST['ename'];
    $ssn = $_POST['ssn'];
    $dept = $_POST['dept'];
    $salary = $_POST['salary'];
    $home = $_POST['home'];

    if (empty($ename && $ssn && $dept && $salary && $home)) {
        echo "<h5>One or many required fields are empty!</h5>";
    } else {

        $sql = "INSERT INTO emp_record(ename, ssn, dept, salary, home) 
                VALUES('$ename', '$ssn', '$dept', '$salary', '$home') ";

        $inserted_data = mysqli_query($conn, $sql);

        if ($inserted_data) {
            echo '<script>window.open("read.php?Insert=Successful", "_self")</script>';
        } else {
            echo '<script>window.open("read.php?Insert=Unsuccessful", "_self")</script>';
        }

    }


}


?>


<!DOCTYPE html>
<html>
<head>
    <title>Insert into Database</title>
</head>
<body>

<div class="input_form" style="width: 400px; margin: auto">

    <h2 style="text-align: center;">Insert Employee Record</h2>

    <form action="insert_into_database.php" method="Post">
        <fieldset>
            <h4>Employee Name:</h4><br><input type="text" name="ename" value=""><br><br>
            <h4>Social Security Number:</h4><br><input type="text" name="ssn" value=""><br><br>
            <h4>Department:</h4><br><input type="text" name="dept" value=""><br><br>
            <h4>Salary:</h4><br><input type="text" name="salary" value=""><br><br>
            <h4>Home Address:</h4><br><textarea name="home" value=""></textarea><br><br>


            <br><input type="submit" name="submit" value="Submit your record"><br><br>
            <h6>*All fields are required.</h6>
        </fieldset>
    </form>


</div>



</body>
</html>
