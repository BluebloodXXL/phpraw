<?php include("includes/headerUC.php") ?>
<?php if (logged_in())
    redirect("overLogin.php");
?>


<body>

<?php include ("includes/navWquery.php"); ?>

<div class="">

<div class="row right">
    <?php validate_user_login(); ?>

</div>

<div class="section container" id="index-banner">

    <div class="row">

        <div class="logCard col l6 s12 offset-l3 " style="padding-top: 10%;">


            <div class="row">
                <div class="col s12">
                    <div class="card blue-grey darken-1">
                        <div class="card-content white-text">
                            <span class="card-title center">Login</span>

                            <form class="" id="login_form" method="post" role="form">

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input name="email" id="email" type="email" class="validate" required>
                                        <label for="email">Email</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input name="password" id="password" type="password" class="validate" required>
                                        <label for="password">Password</label>
                                    </div>
                                </div>

                                <div>
                                    <p>
                                        <label>
                                            <input type="checkbox" name="remember" id="remember" class="orange">
                                            <span>Remember Me</span>
                                        </label>
                                    </p>
                                </div>



                                <div class="row center">
                                    <div class="input-field col s12">
                                        <button class="btn waves-effect waves-red orange" type="submit" name="action">Submit
                                            <i class="material-icons right">send</i>
                                        </button>
                                    </div>
                                    <?php display_message();?>
                                </div>

                            </form>

                        </div>

                        <div class="card-action">

                            <a class="" href="recover.php">Forgot password?</a>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include ("includes/footerWbC.php"); ?>