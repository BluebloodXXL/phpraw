<?php
/**
 * Created by PhpStorm.
 * User: DenVa36
 * Date: 2/26/2019
 * Time: 4:04 PM
 */
//include ("functions/functions.php");
//include ("functions/init.php");
include("includes/header.php");
?>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">SS Enterprise</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item">
                <a class="nav-link" href="employee.php">Employee</a>
            </li>

            <?php if (logged_in()) { ?>
                <li class="nav-item ">
                    <a class="nav-link" href="Home.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="logout.php">Logout <span class="sr-only">(current)</span></a>
                </li>
            <?php } ?>

            <?php if (logged_in_Admin()) { ?>
                <li class="nav-item ">
                    <a class="nav-link" href="admin.php">Admin <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="logout.php">Logout <span class="sr-only">(current)</span></a>
                </li>

            <?php } ?>



            <?php if (!logged_in() && !logged_in_Admin()) { ?>
                <li class="nav-item ">
                    <a class="nav-link" href="login.php">Login <span class="sr-only">(current)</span></a>
                </li>
            <?php } ?>

        </ul>

        <form class="form-inline my-2 my-lg-0">

            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                   name="searchterm">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search">Search</button>

        </form>
        <?php if (logged_in_Admin()) { ?>
        <div class="form-inline my-2 my-lg-0">
            <a href="addUser.php"><button style="margin-left: 6px;" class="btn btn-outline-success my-2 my-sm-0" >Add</button></a>
        </div>
        <?php } ?>
    </div>
</nav>
<div class="container">
    <div class="row">


        <?php

        $sql = "select * from users where r_oll !=9 order by first_name";
        $result = query($sql);

        if (isset($_GET['search'])) {
            try {
                $searchterm = escape($_GET['searchterm']);

                $sql = "SELECT * FROM users
                WHERE first_name LIKE '%$searchterm%'
                   or last_name LIKE '%$searchterm%'
                   or Address LIKE '%$searchterm%'
                   or designation LIKE '%$searchterm%'
                   or department LIKE '%$searchterm%'";


                $result = query($sql);
                if ($con->error) {
                    $error = $con->error;
                }
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }


        if (row_count($result) > 0) {

            while ($alldata = fetch_array($result)) { ?>


                <div class="col-md-6 col-lg-3" style="padding-top: 20px; padding-bottom: 10px;">
                    <div class="card text-center h-100 mx-auto" style="width: auto; border-style: solid; border-width: 4px; border-color: white; border-radius: 0%; ">
                        <img class="card-img-top" src="uploads/<?php echo $alldata['idU']."."."jpg";?>" onerror="this.onerror=null;this.src='uploads/default.jpg';" alt="uploads/default.jpg">
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $alldata['first_name']; ?></h3>
                            <h3 class="card-title"><?php echo $alldata['last_name']; ?></h3>
                            <h6 class="card-text"><?php echo $alldata['designation']?></h6>
                            <h6 class="card-text"><?php echo $alldata['department']?></h6>

                            <?php if (logged_in_Admin()) { ?>
                            <a href="updateUser.php?id=<?php echo $alldata['idU']; ?>" style="text-decoration: none;"> <button class="btn btn-outline-info ">Edit</button></a>
                            <a href="deleteUser.php?id=<?php echo $alldata['idU']; ?>" style="text-decoration: none;"> <button class="btn btn-outline-danger ">Delete</button> </a>
                            <br> <br>
                            <a href="dpUpload.php?id=<?php echo $alldata['idU'];?>"style="text-decoration: none;"><button class="btn btn-outline-dark ">Change Profile Picture</button></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>


            <?php }


        }


        ?>


    </div>
</div>




<?php include ("includes/footer.php"); ?>

