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
if(logged_in_Admin()){

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

            </ul>


        </div>
    </nav>
    <div class="container">
    <div class="row">


    <div class="row col-lg-12" style="padding-top: 10px; padding-bottom: 10px;">
        <div class="card text-center h-100 mx-auto" style="width: auto;">
            <img style="" class="border-primary card-img-top" src="uploads/<?php echo $alldata['idU']."."."jpg";?>" onerror="this.onerror=null;this.src='uploads/default.jpg';" alt="uploads/default.jpg">
            <div class="card-body">
                <h3 class="card-title"><?php echo $alldata['first_name'] . " " . $alldata['last_name']; ?></h3>
                <h6 class="card-text"><?php echo $alldata['designation']?></h6>
                <h6 class="card-text"><?php echo $alldata['department']?></h6>
                <p class="card-text"><?php echo $alldata['Address']?></p>
                <h3>Admin Profile can not be edited</h3>
            </div>
        </div>
    </div>





<?php }
else
    redirect("middleware.php");
include ("includes/footer.php");
?>