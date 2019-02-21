<?php
/**
 * Created by PhpStorm.
 * User: DenVa36
 * Date: 2/18/2019
 * Time: 9:19 AM
 */

include("includes/header.php");
include("includes/nav.php");

?>


<div class="jumbotron">
    <h1 class="text-center">

<?php
if (logged_in()) {
    if (isset($_SESSION['id'])) {

        $id = $_SESSION['id'];
        $sql = "SELECT * FROM users WHERE id = '$id'";
        $result = query($sql);

        if (row_count($result) == 1) {
            $row = fetch_array($result);
            echo "Welcome " . $row['first_name'] . " " . $row['last_name'];
        }
?>
    </h1>
</div>

<?php
$sqlItemUser    = "select * from items i
                   inner join users_items ui on i.id = ui.idItems
                   inner join users u on ui.idUsers = u.id
                   where u.id = '$id'";
$resultItemUser = query($sqlItemUser);

$sqlItemAll     = "select * from items";
$resultItemAll  = query($sqlItemAll);

if (isset($_GET['search'])) {
    try {
        $searchterm = escape($_GET['searchterm']);
        $sqlItemAll = "SELECT * FROM items
                WHERE id LIKE '%$searchterm%'
                or name LIKE '%$searchterm%' 
                or description LIKE '%$searchterm%'
                ORDER BY id";

        $resultItemAll = query($sqlItemAll);
        if ($con->error) {
            $error = $con->error;
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
if (isset($_GET['id'])) {
    redirect("index.php");
}



?>


    <div class="table-responsive">
        <?php
        if (row_count($resultItemUser) > 0) { ?>
        <table class="table">
            <tr>
                <th>No</th>
                <th>Item Name</th>
                <th>Description</th>
                <th>Delete</th>
            </tr>
            <?php
            $i = 0;
            while ($alldata = fetch_array($resultItemUser)) {
                $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $alldata['name']; ?></td>
                    <td><?php echo $alldata['description']; ?></td>
                    <td><a href="deleteItemUser.php?id=<?php echo $alldata['id']; ?>">Delete</a></td>
                </tr>
                <?php
            }
        }
        else {
            echo "<h2>No result Found!</h2>";
        }
            ?>

        </table>
    </div>



    <div class="text-center" style="margin-top: -30px; margin-bottom: 30px;">
        <h2><a href="user.php" style="text-decoration: none;">Our Plans</a></h2>
        <form class="form-inline" role="form" action="user.php" method="GET">
            <div class="form-group" style="margin-top: 10px;">
                <input type="text" class="form-control" name="searchterm" PLACEHOLDER="Search here">
                <input type="submit" class="btn btn-default" name="search" value="Search">
            </div>
        </form>
    </div>

    <div class="table-responsive">


<?php

        if (row_count($resultItemAll) > 0) { ?>
        <table class="table">
            <tr>
                <th>No</th>
                <th>Item Name</th>
                <th>Description</th>
                <th>Add</th>
            </tr>
            <?php
            $i = 0;
            while ($alldata = fetch_array($resultItemAll)) {
                $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $alldata['name']; ?></td>
                    <td><?php echo $alldata['description']; ?></td>
                    <td><a href="addItemUser.php?id=<?php echo $alldata['id']; ?>">Add</a></td>
                </tr>
                <?php
            }
        }
        else {
            echo "<h2>No result Found!</h2>";
        }
            ?>

        </table>
    </div>


<?php

    }
}
elseif (logged_in_Admin()) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if ($id == 11)
            redirect("index.php");
        $sql = "SELECT * FROM users WHERE id = '$id'";
        $result = query($sql);

        if (row_count($result) == 1) {
            $row = fetch_array($result);
            echo "Welcome Admin to " . $row['first_name'] . " " . $row['last_name'] . "'s profile . ";
        }
    }
} else {
    redirect("index . php");
}
?>



<?php include("includes/footer.php") ?>
