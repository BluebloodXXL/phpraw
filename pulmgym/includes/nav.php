<?php
/**
 * Created by PhpStorm.
 * User: duke90
 * Date: 1/8/2019
 * Time: 2:36 AM
 */
?>

<nav style="background-color: black; color: black;" class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand active" href="index.php">PulmGym</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">

                <!--
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
                -->
                <?php if(logged_in()) : ?>
                    <li><a href="user.php">Home</a></li>
                <?php endif; ?>


                <?php if(logged_in_Admin()) : ?>
                    <li class=""><a href="adminHome.php">Home</a></li>
                <!--<li><a href="adminPanel.php">Admin</a></li>-->
                    <li><a href="read.php">Users</a></li>
                    <li><a href="readItem.php">Items</a></li>
                <?php endif; ?>

            </ul>

                <?php if(logged_in() || logged_in_Admin()) : ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="logout.php">Log Out</a></li>
                </ul>
                <?php endif; ?>


                <?php if(!(logged_in()) && !(logged_in_Admin())) : ?>
                <ul class="nav navbar-nav navbar-right">
                    <!--<li><a href="login.php">Log in</a></li>-->
                    <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
                <?php endif; ?>



        </div><!--/.nav-collapse -->
    </div>
</nav>
