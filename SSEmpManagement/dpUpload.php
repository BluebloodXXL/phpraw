<?php
/**
 * Created by PhpStorm.
 * User: DenVa36
 * Date: 2/27/2019
 * Time: 2:48 PM
 */

include ("includes/header.php");


if(logged_in_Admin()){
    if(isset($_GET['id'])){
        $id = clean($_GET['id']);
        $id = escape($id);
        $msg = "";
        if(isset($_POST['upload'])) {
            // the path to store the uploaded image

            // get all the submitted data from the form
            $image = $_FILES['image'];
            $imageName = $_FILES['image']['name'];
            $imageTmpName = $_FILES['image']['tmp_name'];
            $imageSize = $_FILES['image']['size'];
            $imageError = $_FILES['image']['error'];
            $imageType = $_FILES['image']['type'];

            $imageExt = explode('.', $imageName);
            $imageActualExt = strtolower(end($imageExt));
            $allowed =array('jpg');

            if(in_array($imageActualExt, $allowed)) {
                if($imageError === 0){
                    if($imageSize < 100000){
                        //$imageNameNew = uniqid('', true).".".$imageActualExt;
                        $imageNameNew = $id.".".$imageActualExt;
                        $imageDestination = 'uploads/' . $imageNameNew;
                        move_uploaded_file($imageTmpName, $imageDestination);
                        //$sql = "insert into users(dp) values ('$image') where idU = '$id'";
                        //$result = query($sql);
                        redirect("employee.php");
                    }
                    else{
                        $msg = "File too big!";
                    }
                }
                else{
                    $msg = "There was an error with your file";
                }
            }
            else {
                $msg = "You can not upload file of this type only jpg or jpeg allowed.";
            }
        }

            ?>


        <div class="container" style="padding-top: 50px;">
            <div class="row col-lg-12 col-md-12 col-sm-12">
                <div class="card h-100 border-secondary mx-auto shake" style="padding: auto;">
                    <div class="card-body">
                        <div class="text-center">
                            <h2 class="text-center" style="padding-bottom: 10px;">Update Profile Picture</h2>
                            <form action="" enctype="multipart/form-data" method="post" name="upl_frm" class="form-group">
                                <input type="hidden" name="size" value="1000000">
                                <div class="input-group">
                                    <div class="custom-file">

                                        <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="image">

                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>

                                    </div>
                                </div>
                                <br>

                                <button class="btn btn-secondary btn-block" name="upload" type="submit">Upload Now</button>

                            </form>

                            <!--
                            <form action="" enctype="multipart/form-data" method="post" name="upl_frm" class="form-group">
                                <input type="hidden" name=size" value="1000000">
                                <h3>Select Image</h3> <br>

                                <input type="file" name="image"/>
                                <input name="upload" type="submit" value="Upload"/>
                            </form>
                            -->
                        </div>
                    </div>
                    <div class="msg text-center">
                        <?php if (!empty($msg)) echo $msg; ?>
                    </div>
                </div>
            </div>
        </div>

<?php
        }




}
elseif (logged_in()){
    if(isset($_GET['id']))
        redirect("middleware.php");

    if(isset($_SESSION['id'])){
        $id = ($_SESSION['id']);

        $msg = "";
        if(isset($_POST['upload'])) {
            // the path to store the uploaded image

            // get all the submitted data from the form
            $image = $_FILES['image'];
            $imageName = $_FILES['image']['name'];
            $imageTmpName = $_FILES['image']['tmp_name'];
            $imageSize = $_FILES['image']['size'];
            $imageError = $_FILES['image']['error'];
            $imageType = $_FILES['image']['type'];

            $imageExt = explode('.', $imageName);
            $imageActualExt = strtolower(end($imageExt));
            $allowed =array('jpg');

            if(in_array($imageActualExt, $allowed)) {
                if($imageError === 0){
                    if($imageSize < 100000){
                        //$imageNameNew = uniqid('', true).".".$imageActualExt;
                        $imageNameNew = $id.".".$imageActualExt;
                        $imageDestination = 'uploads/' . $imageNameNew;
                        move_uploaded_file($imageTmpName, $imageDestination);
                        //$sql = "insert into users(dp) values ('$image') where idU = '$id'";
                        //$result = query($sql);
                        redirect("Home.php");
                    }
                    else{
                        $msg = "File too big!";
                    }
                }
                else{
                    $msg = "There was an error with your file";
                }
            }
            else {
                $msg = "You can not upload file of this type only jpg or jpeg allowed.";
            }
        }

            ?>

        <div class="container" style="padding-top: 50px;">
            <div class="row col-lg-12 col-md-12 col-sm-12">
            <div class="card h-100 border-secondary mx-auto shake" style="width: 60%; border-style: dashed; border-width: 5px; border-color: #1b1e21;">
                <div class="card-body">
                    <div class="text-center">
                        <h2 class="text-center" style="padding-bottom: 10px;">Update Profile Picture</h2>
                        <form action="" enctype="multipart/form-data" method="post" name="upl_frm" class="form-group">
                            <input type="hidden" name="size" value="1000000">
                        <div class="input-group">
                            <div class="custom-file">

                                <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="image">

                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>

                            </div>
                        </div>
                        <br>

                        <button class="btn btn-secondary btn-block" name="upload" type="submit">Upload Now</button>

                        </form>

                        <!--
                        <form action="" enctype="multipart/form-data" method="post" name="upl_frm" class="form-group">
                            <input type="hidden" name=size" value="1000000">
                            <h3>Select Image</h3> <br>

                            <input type="file" name="image"/>
                            <input name="upload" type="submit" value="Upload"/>
                        </form>
                        -->
                    </div>
                </div>
                <div class="msg text-center">
                    <?php if (!empty($msg)) echo $msg; ?>
                </div>
            </div>
            </div>
        </div>

    <?php
        }

}
else
    redirect("middleware.php");