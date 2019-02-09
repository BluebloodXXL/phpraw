<?php
/**
 * Created by PhpStorm.
 * User: DenVa36
 * Date: 1/25/2019
 * Time: 5:46 AM
 */

include_once 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $id = $_POST['id'];

    if (empty($name)) {
        echo "No change has been made.";
    } else {

        $sql_2 = "UPDATE companies SET name = '$name' WHERE id = '$id'";
        $update_data = mysqli_query($conn, $sql_2);

        if ($update_data) {
            echo "$name " . "has been updated.";
        } else {
            echo "$name " . "has not been updated.";
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

    <h1>Update Data</h1>

    <?php
    $sql_1 = "select * from companies where id = '$id'";
    $result = mysqli_query($conn, $sql_1);
    if ($result) {
        $i = 0;
        while ($alldata = mysqli_fetch_array($result)) {
            $i++;
            ?>

            <form action="" method="POST">
                <input type="hidden" name="id" value="<?php echo $alldata['id']; ?>">
                <input type="text" name="name" placeholder="<?php echo $alldata['name']; ?>">
                </br></br>
                <input type="submit" name="submit" value="Update">
            </form>

            <?php
        }
    }
    ?>

</div>

</body>
</html>
