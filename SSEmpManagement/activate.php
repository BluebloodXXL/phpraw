<?php include("includes/header.php");


if(!($_SERVER['REQUEST_METHOD'] == "GET"))
    redirect("index.php");
elseif ((logged_in()) || (logged_in_Admin()))
    redirect("index.php");



?>



    <div class="jumbotron">
        <h1 class="text-center"><?php activate_user(); ?></h1>
    </div>


<?php include("includes/footer.php") ?>