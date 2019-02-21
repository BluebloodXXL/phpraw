<?php
/**
 * Created by PhpStorm.
 * User: DenVa36
 * Date: 2/18/2019
 * Time: 2:46 PM
 */

include("includes/header.php");
include("includes/nav.php");

if (logged_in_Admin()) {

display_message();

$sql = "SELECT * FROM items ORDER BY id";
$result = query($sql);

if (isset($_GET['search'])) {
    try {
        $searchterm = escape($_GET['searchterm']);
        $sql = "SELECT * FROM items
                WHERE id LIKE '%$searchterm%'
                or name LIKE '%$searchterm%' 
                or description LIKE '%$searchterm%'
                ORDER BY id";

        $result = query($sql);
        if ($con->error) {
            $error = $con->error;
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
if (isset($_GET['insert'])) {
    redirect("insertItem.php");
}

?>


    <div class="text-center" style="margin-top: -30px;">
        <h2><a href="readItem.php" style="text-decoration: none;">Items' Record</a></h2>
        <form class="form-inline" role="form" action="readItem.php" method="GET">
            <div class="form-group" style="margin-top: 10px;">
                <input type="text" class="form-control" name="searchterm" PLACEHOLDER="Search here">
                <input type="submit" class="btn btn-default" name="search" value="Search">
                <input type="submit" class="btn btn-success" name="insert" value="Add">
            </div>
        </form>
    </div>


<div class="Show_Record" style="padding-top: 40px;">
    <div class="table_padding">
        <?php
        if (row_count($result) > 0) {
        ?>
        <table class="table">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Description</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            $i = 0;
            while ($alldata = fetch_array($result)) {
                $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $alldata['name']; ?></td>
                    <td><?php echo $alldata['description']; ?></td>
                    <td><a href="updateItem.php?id=<?php echo $alldata['id']; ?>"><button class="btn btn-warning">&#1422</button></a></td>
                    <td><a href="deleteItem.php?id=<?php echo $alldata['id']; ?>"><button class="btn btn-danger">&#9932</button></a></td>
                </tr>
                <?php
            }
            } else {
                echo "<h2>No result Found!</h2>";
            }
            ?>

        </table>
    </div>


    <?php

    }
    else
        redirect("index.php");

    ?>
</div>


<?php include("includes/footer.php"); ?>

