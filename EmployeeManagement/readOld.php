<?php
/**
 * Created by PhpStorm.
 * User: DenVa36
 * Date: 1/24/2019
 * Time: 7:11 AM
 */

include_once 'Connection.php';
$sql = "select * from emp_record";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>
        Employee Record
    </title>
</head>
<body>
<div class="Show_Record" style="width: 1280px; margin: auto; text-align: center;">

    <h2>Employee Record</h2>

    <div class="table_padding" style="padding-left: 120.5px; padding-right: 120.5px;">

        <table border="1px;" align="center">
            <tr>
                <th>No</th>
                <th>First Name</th>
                <th>SSN</th>
                <th>Dpt</th>
                <th>Salary(BDT)</th>
                <th>Current Address</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

            <?php

            if ($result) {
                $i = 0;
                while ($alldata = mysqli_fetch_array($result)) {
                    $i++;
                    ?>

                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $alldata['ename']; ?></td>
                        <td><?php echo $alldata['ssn']; ?></td>
                        <td><?php echo $alldata['dept']; ?></td>
                        <td><?php echo $alldata['salary']; ?></td>
                        <td><?php echo $alldata['home']; ?></td>
                        <td><a href="update.php?id=<?php echo $alldata['id']; ?>">Edit</a></td>
                        <td><a href=delete.php?id=<?php echo $alldata['id']; ?>">Delete</a></td>
                    </tr>

                    <?php
                }
            }
            ?>

        </table>
    </div>

    <?php

    if (isset($_GET['Delete'])) {
        $delete = $_GET['Delete'];
        echo "<h4> Deletion ".$delete."</h4>";
    }
    if (isset($_GET['Update'])) {
        $update = $_GET['Update'];
        echo "<h4> Update ".$update."</h4>";
    }
    if (isset($_GET['Insert'])) {
        $insert = $_GET['Insert'];
        echo "<h4> Insertion ".$insert."</h4>";
    }
    ?>

</div>

</body>

</html>


