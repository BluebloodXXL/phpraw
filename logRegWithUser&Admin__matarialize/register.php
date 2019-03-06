<?php include("includes/headerUC.php") ?>
<?php if (logged_in())
    redirect("overLogin.php");
?>


    <body>

    <?php include ("includes/navWquery.php"); ?>


    <div class="section " id="index-banner">
        <div class="container">
            <br><br>
            <h1 class="header center orange-text">Registration Form</h1>
            <div class="row center">
                <h5 class="header col s12 light">Please fill out the form to register</h5>
            </div>

            <br><br>

        </div>
    </div>


    <div class="container section" id="index-banner">

        <div class="row">

            <div class="col l8 col m8 offset-l2 offset-m2">

                <form class="" id="register-form" method="post" role="form">


                    <div class="row">
                        <div class="input-field col l4 m4 s12">
                            <input name="first_name" id="first_name" type="text" class="validate" required>
                            <label for="first_name">First Name</label>
                        </div>
                        <div class="input-field col l4 m4 s12">
                            <input name="last_name" id="last_name" type="text" class="validate" required>
                            <label for="last_name">Last Name</label>
                        </div>
                        <div class="input-field col l4 m4 s12">
                            <input name="user_name" id="user_name" type="text" class="validate" required>
                            <label for="user_name">User Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col l6 m6 s12">
                            <input name="password" id="password" type="password" class="validate" required>
                            <label for="password">Password</label>
                        </div>

                        <div class="input-field col l6 m6 s12">
                            <input name="confirm_password" id="confirm_password" type="password" class="validate" required>
                            <label for="confirm_password">Confirm Password</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input name="email" id="email" type="email" class="validate" required>
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <br>
                    <div class="row center">
                        <div class="input-field col s12">
                            <button class="btn waves-effect waves-red orange" type="submit" name="action">Submit
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>



                </form>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="row center">
            <?php validate_user_registration(); ?>
        </div>
    </div>


<?php include("includes/footerWbC.php"); ?>