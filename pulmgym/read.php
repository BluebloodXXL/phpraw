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

$sql = "SELECT * FROM users WHERE r_oll != 9 ORDER BY id";
$result = query($sql);

if (isset($_GET['search'])) {
    try {
        $searchterm = escape($_GET['searchterm']);
        $sql = "SELECT * FROM users
                WHERE (id LIKE '%$searchterm%'
                or first_name LIKE '%$searchterm%' 
                or last_name LIKE '%$searchterm%'
                or username LIKE '%$searchterm%'
                or email LIKE '%$searchterm%')
                AND r_oll != 9
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
    redirect("insert.php");
}

?>


    <div class="text-center" style="margin-top: -30px;">
        <h2><a href="read.php" style="text-decoration: none;">Users' Record</a></h2>
        <form class="form-inline" role="form" action="read.php" method="GET">
            <div class="form-group" style="margin-top: 10px;">
                <input type="text" class="form-control" name="searchterm" PLACEHOLDER="Search here">
                <input type="submit" class="btn btn-default" name="search" value="Search">
                <input type="submit" class="btn btn-success" name="insert" value="Insert">
            </div>
        </form>
    </div>


<div class="Show_Record" style="padding-top: 40px;">
    <div class=" table-responsive">
        <?php
        if (row_count($result) > 0) {
        ?>
        <table class="table">
            <tr>
                <th>No</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>User Name</th>
                <th>Validation Code</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Profile</th>
            </tr>
            <?php
            $i = 0;
            while ($alldata = fetch_array($result)) {
                $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $alldata['first_name']; ?></td>
                    <td><?php echo $alldata['last_name']; ?></td>
                    <td><?php echo $alldata['email']; ?></td>
                    <td><?php echo $alldata['username']; ?></td>
                    <td><?php echo $alldata['validation_code']; ?></td>
                    <td><?php if ($alldata['active'] == 1) echo "Active"; else echo "Inactive" ?></td>
                    <td><a href="update.php?id=<?php echo $alldata['id']; ?>"><button class="btn btn-warning">&#1422</button> </a></td>
                    <td><a href="delete.php?id=<?php echo $alldata['id']; ?>"><button class="btn btn-danger">&#9932</button></a></td>
                    <td><a href="user.php?id=<?php echo $alldata['id']; ?>"><button class="btn btn-info">&#8667</button></a></td>
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

    if (isset($_GET['Delete'])) {
        $delete = $_GET['Delete'];
        echo "<h4> Deletion " . $delete . "</h4>";
    }
    if (isset($_GET['Update'])) {
        $update = $_GET['Update'];
        echo "<h4> Update " . $update . "</h4>";
    }
    if (isset($_GET['Insert'])) {
        $insert = $_GET['Insert'];
        echo "<h4> Insertion " . $insert . "</h4>";
    }

    }
    else
        redirect("index.php");

    ?>
</div>


<?php include("includes/footer.php"); ?>

