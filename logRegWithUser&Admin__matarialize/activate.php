<?php include ("includes/headerUC.php"); ?>
<?php if(logged_in()) redirect("overLogin.php"); ?>
<?php include ("includes/navWquery.php"); ?>


<div class="section container" id="index-banner">
    <div class="row">
        <h1 class="green"><?php activate_user(); ?></h1>
    </div>
</div>


<?php include ("includes/footerWbC.php"); ?>

