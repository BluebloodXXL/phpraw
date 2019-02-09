<?php
/**
 * Created by PhpStorm.
 * User: DenVa36
 * Date: 1/24/2019
 * Time: 7:11 AM
 */

include_once 'config.php';
$sql = "select * from companies";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>
        PhpMysql CRUD
    </title>
</head>
<body>
<div class="center" style="margin: 2% 20% 20% 35%;">

    <h1>Display Data</h1>

    <table border="2px;">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Action</th>
        </tr>

        <?php

        if ($result) {
            $i = 0;
            while ($alldata = mysqli_fetch_array($result)) {
                $i++;
        ?>

                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $alldata['name']; ?></td>
                    <td><a href="update.php?id=<?php echo $alldata['id']; ?>">Edit</a> || <a href=delete.php?id=<?php echo $alldata['id']; ?>">Delete</a></td>
                </tr>

        <?php
            }
        }
        ?>

    </table>

</div>

</body>

</html>


