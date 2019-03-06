<?php
/**
 * Created by PhpStorm.
 * User: DenVa36
 * Date: 2/26/2019
 * Time: 3:47 PM
 */

include ("includes/header.php"); ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
    <a class="navbar-brand" href="index.php">SS Enterprise</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

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

            <li class="nav-item">
                <a class="nav-link" href="employee.php">Employee</a>
            </li>
            <?php if (!logged_in() && !logged_in_Admin()) { ?>
                <li class="nav-item ">
                    <a class="nav-link" href="login.php">Login <span class="sr-only">(current)</span></a>
                </li>
            <?php } ?>

        </ul>

    </div>
</nav>



<div class="container-fluidDIS">

<div class="jumbotron" style="border-radius: 0px; background-color: #9fcdff;">
    <div style="margin-top: -30px;">
        <h2 ">Welcome to SS Enterprise</h2>
        <h3>We provide Marketing &</h3>
        <h4>Software Solution</h4>
    </div>

    <h6 class="text-right">We belive in proficiency and consistency more than intensity</h6>

    <div class="text-right" style="margin-top: 10px;">
        <a style="text-decoration: none; color: #b21f2d" href="registration.php"><button class="text-right btn btn-outline-success">JOIN US</button></a>
    </div>
</div>



</div>
























<?php include ("includes/footer.php"); ?>