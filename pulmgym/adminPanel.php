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

?>

<div class="jumbotron">
    <h1 class="text-center">

        <?php

        $sqlO = "SELECT * FROM users WHERE r_oll != 9 ORDER BY id";
        $resultO = query($sqlO);

        if (isset($_SESSION['id'])) {
            $id = $_SESSION['id'];
            $sql = "SELECT * FROM users WHERE id = $id";
            $result = query($sql);

            if (row_count($result) > 0) {
                $row = fetch_array($result);
                echo "Welcome " . $row['first_name'] . " " . $row['last_name'];
            }
        }
        }
        else {
            redirect("index.php");
        }


        ?>
    </h1>
</div>

<div>

    <a href ="read.php" style="text-decoration: none;">
        <button type="button" class="btn btn-primary btn-lg">
            Users
        </button>
    </a>

    <a href ="read.php" style="text-decoration: none;">
        <button type="button" class="btn btn-primary btn-lg">
            Items
        </button>
    </a>


</div>










<?php include("includes/footer.php"); ?>


