<?php
/**
 * Created by PhpStorm.
 * User: DenVa36
 * Date: 2/18/2019
 * Time: 9:19 AM
 */

include("includes/headerWOcontainer.php");
include("includes/nav.php");

if (logged_in()) {
    if (isset($_SESSION['id'])) {

        $id = $_SESSION['id'];
        // $email = $_COOKIE['email'];

        $sql = "SELECT * FROM users WHERE id = '$id'";
        $result = query($sql);

        if (row_count($result) == 1) {
            $row = fetch_array($result);

            echo "<div class='jumbotron' style='background-color: black; color: snow; height: 115px; padding-bottom: 20px; margin-top: -40px; width: 100%;'>
                    <div class='container'>
                        <div class='row'>
                            <div class='col-lg-12'>
                                <h1 style='margin-top: -25px;' class='text-center'>Welcome " . $row['first_name'] ."</h1>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class='container'>";

        }




$sqlItemUser    = "select * from items i
                   inner join users_items ui on i.id = ui.idItems
                   inner join users u on ui.idUsers = u.id
                   where u.id = '$id'
                   ORDER BY i.id";
$resultItemUser = query($sqlItemUser);


$sqlItemAll     = "select * from items ORDER BY id";
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


<div class="text-center" style="margin-bottom: 50px;">
    <h2><a href="user.php" style="color: darkslateblue; text-decoration: none;">Subscriptions <?php// echo "$row_count($resultItemUser)";?></a></h2>
</div>

    <!--<div class="table-responsive">-->

    <?php if (row_count($resultItemUser) > 0) {?>
        <!--
        <table class="table">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            -->
            <div class="row">
            <?php
            $i = 0;
            while ($alldata = fetch_array($resultItemUser)) {
                $i++;
                ?>

                <div class="col-lg-12 col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <div class="caption">
                            <h3><?php echo $alldata['name']; ?></h3>
                            <p class="card-text"><?php echo $alldata['description']; ?></p>
                            <a href="deleteItemUser.php?itemid=<?php echo $alldata['idItems']; ?>"><button class="btn btn-danger" >Unsubscribe</button></a>
                        </div>
                    </div>
                </div>


                <!--
                <tr>
                    <td><?php// echo $i; ?></td>
                    <td><?php// echo $alldata['name']; ?></td>
                    <td><?php// echo $alldata['description']; ?></td>
                    <td><a href="deleteItemUser.php?itemid=<?php// echo $alldata['idItems']; ?>"><button class="btn btn-danger" >Unsubscribe</button></a></td>
                </tr>
                -->


                <?php
            }
            ?>
            </div>
            <?php
        }
        else {
            echo "<h2 class='text-center' style='color: red;'>You have not chosen any plan yet</h2>";
        }
            ?>

<!--
        </table>
    </div>
-->

    <div class="text-center" style="margin-bottom: 30px;">
        <h2><a href="user.php" style="color: darkslateblue; text-decoration: none;">Our Plans</a></h2>
        <form class="form-inline" role="form" action="user.php" method="GET">
            <div class="form-group" style="margin-top: 10px;">
                <input type="text" class="form-control" name="searchterm" PLACEHOLDER="Search here">
                <input type="submit" class="btn btn-default" name="search" value="Search">
            </div>
        </form>
    </div>








<?php  if (row_count($resultItemAll) > 0) { ?>

<!--
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>No</th>
                <th>Item Name</th>
                <th>Description</th>
                <th>Add</th>
            </tr>
-->
            <div class="row">
        <?php
            $i = 0;
            while ($alldata = fetch_array($resultItemAll)) {
                $i++;
        ?>

                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <div class="caption">
                            <h3><?php echo $alldata['name']; ?></h3>
                            <p class="card-text"><?php echo $alldata['description']; ?></p>
                            <a href="addItemUser.php?itemid=<?php echo $alldata['id']; ?>&id=<?php echo $id;?>" class="btn btn-success">Subscribe</a>
                        </div>
                    </div>
                </div>

                <!--
                <tr>
                    <td><?php// echo $i; ?></td>
                    <td><?php// echo $alldata['name']; ?></td>
                    <td><?php// echo $alldata['description']; ?></td>
                    <td><a href="addItemUser.php?itemid=<?php// echo $alldata['id']; ?>">Add</a></td>
                </tr>
                -->
        <?php

            }
            ?>
            </div>
                <?php
        }
        else {
            echo "<h2 style='color: red;' class='text-center'>No Result Found !</h2>";
        }

        ?>

<!--
        </table>
    </div>
-->

<?php

    }
}
elseif (logged_in_Admin()) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];


        if ($id == 11)
            redirect("adminHome.php");

        $sql = "SELECT * FROM users WHERE id = '$id'";
        $result = query($sql);


        if (row_count($result) == 1) {
            $row = fetch_array($result);
            echo
                "<div class='jumbotron' style='background-color: black; color: snow; height: 115px; padding-bottom: 20px; margin-top: -40px; width: 100%;'>
                    <div class='container'>
                        <div class='row'>
                            <div class='col-lg-12'>
                                <h1 style='margin-top: -25px;' class='text-center'>Welcome " . $row['first_name'] ."</h1>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class='container'>";
        }



        $sqlItemUser = "select * from items i
                           inner join users_items ui on i.id = ui.idItems
                           inner join users u on ui.idUsers = u.id
                           where u.id = '$id'
                           ORDER BY i.id";
        $resultItemUser = query($sqlItemUser);



        $sqlItemAll = "select * from items ORDER BY id";
        $resultItemAll = query($sqlItemAll);



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


?>




    <div class="table-responsive">
<?php if (row_count($resultItemUser) > 0) { ?>
        <table class="table">
            <tr>
                <th>No</th>
                <th>Item Name</th>
                <th>Description</th>
                <th>Action</th>
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
                    <td><a href="deleteItemUser.php?itemid=<?php echo $alldata['idItems']; ?>&id=<?php echo $id;?>"><button class="btn btn-danger">Unsubscribe</button></a></td>
                </tr>


        <?php

            }
        }
        else {
              echo "<h2 style='color: red;' class='text-center'>This user has not chosen any plan yet!</h2>";
        }
        ?>



        </table>
    </div>


    <h2 class="text-center" style="padding-bottom: 30px;"><a href="user.php?id=<?php echo $id;?>" style="color: darkslateblue;text-decoration: none; ">Our Plans</a></h2>

<!--
    <div class="text-center" style="margin-top: -30px; margin-bottom: 30px;">
        <h2><a href="user.php?id=<?php //echo $id;?>" style="text-decoration: none;">Our Plans</a></h2>
        <form class="form-inline" role="form" action="" method="GET">
            <div class="form-group" style="margin-top: 10px;">
                <input type="text" class="form-control" name="searchterm" PLACEHOLDER="Search here">
                <input type="submit" class="btn btn-default" name="search" value="Search">
            </div>
        </form>
    </div>


    <div class="table-responsive">
-->

        <?php if (row_count($resultItemAll) > 0) { ?>
<!--
        <table class="table">
            <tr>
                <th>No</th>
                <th>Item Name</th>
                <th>Description</th>
                <th>Add</th>
            </tr>

-->
            <div class="row">

        <?php
            $i = 0;
            while ($alldata = fetch_array($resultItemAll)) {
                $i++;
        ?>

                <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div class="caption">
                                <h3><?php echo $alldata['name']; ?></h3>
                                <p class="card-text"><?php echo $alldata['description']; ?></p>
                                <a href="addItemUser.php?itemid=<?php echo $alldata['id']; ?>&id=<?php echo $id;?>" class="btn btn-success">Subscribe</a>
                            </div>
                        </div>
                </div>










<!--
                <tr>
                    <td><?php// echo $i; ?></td>
                    <td><?php// echo $alldata['name']; ?></td>
                    <td><?php// echo $alldata['description']; ?></td>
                    <td><a href="addItemUser.php?itemid=<?php // echo $alldata['id']; ?>&id=<?php // echo $id;?>">Add</a></td>
                </tr>
-->



        <?php
            }
            ?>

                </div>

            <?php

        }
        else {
                echo "<h2 style='color: red;' class='text-center'>No result found!</h2>";
            }
        ?>
<!--
        </table>
    </div>
-->


<?php
    }
}
else {
    redirect("index.php");
}



include("includes/footer.php"); ?>
