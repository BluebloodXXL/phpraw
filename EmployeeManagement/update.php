<?php
/**
 * Created by PhpStorm.
 * User: DenVa36
 * Date: 1/25/2019
 * Time: 5:46 AM
 */

include_once 'Connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if (isset($_POST['submit'])) {

    $ename = $_POST['ename'];
    $ssn = $_POST['ssn'];
    $dept = $_POST['dept'];
    $salary = $_POST['salary'];
    $home = $_POST['home'];
    $id = $_POST['id'];

    if (empty($ename)) {
        echo "No change has been made.";
    } else {

        $sql_1 = "UPDATE emp_record SET ename = '$ename' WHERE id = '$id'";
        $sql_2 = "UPDATE emp_record SET ssn = '$ssn' WHERE id = '$id'";
        $sql_3 = "UPDATE emp_record SET dept = '$dept' WHERE id = '$id'";
        $sql_4 = "UPDATE emp_record SET salary = '$salary' WHERE id = '$id'";
        $sql_5 = "UPDATE emp_record SET home = '$home' WHERE id = '$id'";

        $update_1 = mysqli_query($conn, $sql_1);
        $update_2 = mysqli_query($conn, $sql_2);
        $update_3 = mysqli_query($conn, $sql_3);
        $update_4 = mysqli_query($conn, $sql_4);
        $update_5 = mysqli_query($conn, $sql_5);

        if ($update_1 && $update_2 && $update_3 && $update_4 && $update_5) {
            echo '<script>window.open("read.php?Update=Successful", "_self")</script>';
        } else {
            echo '<script>window.open("read.php?Update=Unsuccessful", "_self")</script>';
        }

    }
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>
        Update
    </title>
</head>


<body>

<div class="input_form" style="width: 400px; margin: auto">

    <h2 style="text-align: center;">Update Data</h2>

    <?php
    $sql_1 = "select * from emp_record where id = '$id'";
    $result = mysqli_query($conn, $sql_1);
    if ($result) {
    $i = 0;
    while ($alldata = mysqli_fetch_array($result)) {
    $i++;
    ?>


    <form action="" method="Post">
        <fieldset>
            <input type="hidden" name="id" value="<?php echo $alldata['id']; ?>">
            <h4>Employee Name:</h4><br><input type="text" name="ename" value="<?php echo $alldata['ename']; ?>"><br><br>
            <h4>Social Security Number:</h4><br><input type="text" name="ssn"
                                                       value="<?php echo $alldata['ssn']; ?>"><br><br>
            <h4>Department:</h4><br><input type="text" name="dept" value="<?php echo $alldata['dept']; ?>"><br><br>
            <h4>Salary:</h4><br><input type="text" name="salary" value="<?php echo $alldata['salary']; ?>"><br><br>
            <h4>Home Address:</h4><br><input name="home" value="<?php echo $alldata['home']; ?>"><br><br>


            <br><input type="submit" name="submit" value="Update"><br><br>
            <h6>*All fields are required.</h6>
        </fieldset>
    </form>
</div>

<?php
}
}
?>

</div>

</body>
</html>
