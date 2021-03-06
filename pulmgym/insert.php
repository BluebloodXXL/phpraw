<?php
/**
 * Created by PhpStorm.
 * User: DenVa36
 * Date: 2/19/2019
 * Time: 3:21 AM
 */

include("includes/header.php");
include("includes/nav.php");

if (logged_in_Admin()) {

    display_message();

    ?>


    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <?php validate_user_insertion(); ?>
        </div>


    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">


                        <div class="col-xs-12">
                            <a href="insert.php" class="active" id="">Insert</a>
                        </div>

                    </div>
                    <hr>
                </div>


                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <form id="register-form" method="post" role="form">

                                <div class="form-group">
                                    <input type="text" name="first_name" id="first_name" tabindex="1"
                                           class="form-control" placeholder="Fist Name" value="" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="last_name" id="last_name" tabindex="1" class="form-control"
                                           placeholder="Last Name" value="" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="username" id="username" tabindex="1" class="form-control"
                                           placeholder="Username" value="" required>
                                </div>

                                <div class="form-group">
                                    <input type="email" name="email" id="register_email" tabindex="1"
                                           class="form-control" placeholder="Email Address" value="" required>
                                </div>

                                <div class="form-group">
                                    <input type="password" name="password" id="password" tabindex="2"
                                           class="form-control" placeholder="Password" required>
                                </div>

                                <div class="form-group">
                                    <input type="password" name="confirm_password" id="confirm-password" tabindex="2"
                                           class="form-control" placeholder="Confirm Password" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="active" id="active" tabindex="1"
                                           class="form-control" placeholder="0 for inactive & 1 for active" required>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="insert_submit" id="insert-submit"
                                                   tabindex="4" class="form-control btn btn-register"
                                                   value="Inset Now">
                                        </div>
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("includes/footer.php") ?>


<?php
}
else
    redirect("index.php");

?>