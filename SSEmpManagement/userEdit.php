<?php
/**
 * Created by PhpStorm.
 * User: DenVa36
 * Date: 2/19/2019
 * Time: 3:21 AM
 */

include("includes/header.php");


if (logged_in()) {

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">SS Enterprise</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <?php if (logged_in()) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="Home.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout <span class="sr-only">(current)</span></a>
                </li>
            <?php } ?>


            <li class="nav-item">
                <a class="nav-link" href="employee.php">Employee</a>
            </li>

        </ul>

    </div>
</nav>

<div class="rowDIS">
    <div class="col-lg-6 col-lg-offset-3">
        <?php
        if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];

        $sql = "SELECT * FROM users WHERE idU = '$id' ";
        $result = query($sql);
        if (row_count($result) > 0) {
        $row = fetch_array($result);
        validate_user_update($id);
        ?>
    </div>

    <div class="container">


        <h2 class="col-xs-12 text-center" style="padding-top: 50px; padding-bottom: 50px;">
            <a href="userEdit.php" class="active" style="text-decoration: none;"
               id=""><?php echo "Updating " . ($row['first_name']); ?></a>
        </h2>

        <form method="post" role="form">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="<?php echo $row['email']; ?>" placeholder="<?php echo $row['email']; ?>">

            </div>


            <div class="form-group">
                <label for="exampleInputEmail1">First Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="first_name" value="<?php echo $row['first_name']; ?>" placeholder="<?php echo $row['first_name']; ?>">

            </div>


            <div class="form-group">
                <label for="exampleInputEmail1">last Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="last_name" value="<?php echo $row['last_name']; ?>" placeholder="<?php echo $row['last_name']; ?>">

            </div>


            <div class="form-group">
                <label for="exampleInputEmail1">Designation</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="designation" value="<?php echo $row['designation']; ?>" placeholder="<?php echo $row['designation']; ?>">

            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Address</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="Address" value="<?php echo $row['Address']; ?>" placeholder="<?php echo $row['Address']; ?>">

            </div>

            <div>
                <label for="exampleInputEmail1">Department</label>
                <select class="form-control" name="department">
                    <option selected><?php echo $row['department']; ?></option>
                    <option value="Accounts and Finance">Accounts and Finance</option>
                    <option value="Sales and marketing">Sales and marketing</option>
                    <option value="Infrastructures">Infrastructures</option>
                    <option value="Research and development">Research and development</option>
                    <option value="Learning and development">Learning and development</option>
                    <option value="IT services">IT services</option>
                    <option value="Product development">Product development</option>
                    <option value="Admin department">Admin department</option>
                    <option value="Security and transport.">Security and transport.</option>
                    <option value="HR">HR</option>
                    <option value="Software">Software</option>
                </select>
            </div>

            <br>

            <div>
                <label for="exampleInputEmail1">Status</label>
                <select class="form-control" name="active">
                    <option selected value="<?php echo $row['active']; ?>"><?php echo $row['active']; ?></option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>

                </select>
            </div>

            <br>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>



    </div>

</div>


    <?php
    } else {
        set_message("<p class='bg-danger text-center'>No Such ID</p>");
        redirect("update.php");
    }
    } else {
        $error = 'NO ID IS SELECTED';
        echo display_warning_message($error);
    }

    } else
        redirect("index.php");


    ?>


    <?php include("includes/footer.php") ?>
