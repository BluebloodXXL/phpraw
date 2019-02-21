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
    <?php
    if (isset($_GET['id'])) {
        $id = clean($_GET['id']);
        $id = escape($id);
        $sql = "SELECT * FROM users WHERE id = $id ";
        $result = query($sql);
        if (row_count($result) > 0) {
            $row = fetch_array($result);
            validate_user_update($id);
            ?>
            </div>


            </div>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-login">
                        <div class="panel-heading">
                            <div class="row">


                                <div class="col-xs-12">
                                    <a href="<?php echo "update.php?id=" . $row['id']; ?>" class="active"
                                       id=""><?php echo "Updating " . ($row['first_name']); ?></a>
                                </div>

                            </div>
                            <hr>
                        </div>


                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">

                                    <form id="update-form" method="post" role="form">

                                        <div class="form-group">
                                            <input type="text" name="first_name" id="first_name" tabindex="1"
                                                   class="form-control"
                                                   placeholder="<?php echo $row['first_name'] ?>" value="<?php echo $row['first_name'] ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="last_name" id="last_name" tabindex="1"
                                                   class="form-control"
                                                   placeholder="<?php echo $row['last_name'] ?>" value="<?php echo $row['last_name'] ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="username" id="username" tabindex="1"
                                                   class="form-control"
                                                   placeholder="<?php echo $row['username'] ?>" value="<?php echo $row['username'] ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <input type="email" name="email" id="register_email" tabindex="1"
                                                   class="form-control" placeholder="<?php echo $row['email'] ?>" value="<?php echo $row['email'] ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="active" id="active" tabindex="1"
                                                   class="form-control" placeholder="<?php echo $row['active'] ?> (0 for inactive & 1 for active)" value="<?php echo $row['active'] ?>"
                                                   required>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <input type="submit" name="insert_submit" id="insert-submit"
                                                           tabindex="4" class="form-control btn btn-register"
                                                           value="Update Now">
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
        }
        else {
            set_message("<p class='bg-danger text-center'>No Such ID</p>");
            redirect("update.php");
        }
    }
    else{
        $error = 'NO ID IS SELECTED';
        echo display_warning_message($error);
    }

}
else
    redirect("index.php");


?>


<?php include("includes/footer.php") ?>
