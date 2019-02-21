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
        $sql = "SELECT * FROM items WHERE id = $id ";
        $result = query($sql);
        if (row_count($result) > 0) {
            $row = fetch_array($result);
            validate_item_update($id);
            ?>
            </div>


            </div>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-login">
                        <div class="panel-heading">
                            <div class="row">


                                <div class="col-xs-12">
                                    <a href="<?php echo "updateItem.php?id=" . $row['id']; ?>" class="active"
                                       id=""><?php echo "Updating item " . ($row['name']); ?></a>
                                </div>

                            </div>
                            <hr>
                        </div>


                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">

                                    <form id="update-form" method="post" role="form">

                                        <div class="form-group">
                                            <input type="text" name="name" id="name" tabindex="1"
                                                   class="form-control"
                                                   placeholder="<?php echo $row['name'] ?>" value="<?php echo $row['name'] ?>" required>
                                        </div>


                                        <div class="form-group">
                                            <input type="text" rows="3" name="description" id="description" tabindex="5"
                                                class="form-control" style="width: 525px; height: 200px;"
                                                placeholder="<?php echo $row['description'] ?>" value="<?php echo $row['description'] ?>" required>
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
