<?php
/**
 * Created by PhpStorm.
 * User: DenVa36
 * Date: 2/26/2019
 * Time: 9:53 PM
 */

include("includes/header.php");
?>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">SS Enterprise</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <?php if (logged_in()) { ?>
                <li class="nav-item active">
                    <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
                </li>
            <?php } ?>

            <?php if (logged_in_Admin()) { ?>
                <li class="nav-item active">
                    <a class="nav-link" href="admin.php">Admin <span class="sr-only">(current)</span></a>
                </li>
            <?php } ?>

            <li class="nav-item">
                <a class="nav-link" href="employee.php">Employee</a>
            </li>

        </ul>

        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                   name="searchterm">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search">Search</button>
        </form>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">

    <?php display_message(); ?>

    </div>
</div>




<?php include ("includes/footer.php"); ?>

