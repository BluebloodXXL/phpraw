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
if(logged_in()){

    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];

        $sql = "select * from users where idU = '$id'";
        $resutl = query($sql);
        $alldata = fetch_array($resutl);
    }

    ?>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">SS Enterprise</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <?php if (logged_in()) { ?>
                <li class="nav-item ">
                    <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="logout.php">Logout <span class="sr-only">(current)</span></a>
                </li>
            <?php } ?>

            <li class="nav-item">
                <a class="nav-link" href="employee.php">Employee</a>
            </li>

        </ul>

    </div>
</nav>
<div class="container">
    <div class="row">


    <div class="row col-lg-12 col-xl-12" style="padding-top: 10px; padding-bottom: 10px;">
        <div class="card text-center h-100 w-50 mx-auto" style="width: auto; border-style: dotted; border-width: 7px; border-color: #1b1e21;" >
            <img style="" class="border-primary card-img-top" src="uploads/<?php echo $alldata['idU']."."."jpg";?>" onerror="this.onerror=null;this.src='uploads/default.jpg';" alt="uploads/default.jpg">
            <div class="card-body">
                <h3 class="card-title"><?php echo $alldata['first_name'] . " " . $alldata['last_name']; ?></h3>
                <h6 class="card-text"><?php echo $alldata['designation']?></h6>
                <h6 class="card-text"><?php echo $alldata['department']?></h6>
                <p class="card-text"><?php echo $alldata['Address']?></p>
                <a href="userEdit.php" style="text-decoration: none;"> <button class="btn btn-outline-info btn-block btn-sm">Edit</button></a>
                <br>
                <a href="dpUpload.php" style="text-decoration: none;"><button class="btn btn-outline-secondary btn-block btn-sm">Change Profile Picture</button></a>
            </div>
        </div>
    </div>





<?php }
else
    redirect("middleware.php");
include ("includes/footer.php");
?>