<?php include("includes/headerUC.php") ?>
<?php if (logged_in())
    redirect("overLogin.php");
?>


    <body>

<?php include ("includes/navWquery.php"); ?>

<div class="">
    <div class="section container" id="index-banner">

        <div class="row">

            <div class="logCard col l6 s12 offset-l3 " style="padding-top: 10%;">

                <?php password_reset(); ?>

                <div class="row">
                    <div class="col s12">
                        <div class="card blue-grey darken-1">
                            <div class="card-content white-text">
                                <span class="card-title center">Reset Password</span>

                                <form class="" id="login_form" method="post" role="form">


                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input name="password" id="password" type="password" class="validate" required>
                                            <label for="password">Password</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input name="confirm_password" id="confirm_password" type="password" class="validate" required>
                                            <label for="confirm_password">Confirm password</label>
                                        </div>
                                    </div>



                                    <div class="row center">
                                        <div class="input-field col s12">
                                            <button class="btn waves-effect waves-red red" type="submit" name="action">Confirm
                                                <i class="material-icons right">send</i>
                                            </button>
                                        </div>
                                    </div>

                                    <input type="hidden" class="hide" name="token" id="token" value="<?php echo token_generator(); ?>">

                                </form>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include ("includes/footerWbC.php"); ?>