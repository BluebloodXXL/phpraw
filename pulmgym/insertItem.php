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
            <?php validate_item_insertion(); ?>
        </div>


    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">


                        <div class="col-xs-12">
                            <a href="insert.php" class="active" id="">Insert Item</a>
                        </div>

                    </div>
                    <hr>
                </div>


                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <form id="register-form" method="post" role="form">

                                <div class="form-group">
                                    <input type="text" name="name" id="name" tabindex="1"
                                           class="form-control" placeholder="Item Name" value="" required>
                                </div>


                                <div class="form-group">
                                    <textarea type="text" rows="3" name="description" id="description" tabindex="1"
                                              class="form-control"
                                              placeholder="Description" value="" required></textarea>
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

    <?php
    include("includes/footer.php");


} else
    redirect("index.php");

?>