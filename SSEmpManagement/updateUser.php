<?php
/**
 * Created by PhpStorm.
 * User: DenVa36
 * Date: 2/19/2019
 * Time: 3:21 AM
 */

include("includes/header.php");


if (logged_in_Admin()) {

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

            <?php if (logged_in_Admin()) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="admin.php">Admin <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout <span class="sr-only">(current)</span></a>
                </li>
            <?php } ?>

            <li class="nav-item">
                <a class="nav-link" href="employee.php">Employee</a>
            </li>

        </ul>

        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                   name="searchterm">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search">Search</button>
        </form>
    </div>
</nav>

    <div class="row">
    <div class="col-lg-6 col-lg-offset-3">
    <?php
    if (isset($_GET['id'])) {
        $id = clean($_GET['id']);
        $id = escape($id);
        $sql = "SELECT * FROM users WHERE idU = '$id' ";
        $result = query($sql);
        if (row_count($result) > 0) {
            $row = fetch_array($result);
            validate_user_update($id);
            ?>
            </div>

            <div class="container">


            <h2 class="col-xs-12 text-center" style="padding-top: 50px; padding-bottom: 50px;">
                <a href="<?php echo "updateUser.php?id=" . $row['idU']; ?>" class="active" style="text-decoration: none;"
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


                <div>
                    <label for="exampleInputEmail1">Designation</label>
                    <select class="form-control" name="designation" required>
                        <option selected><?php echo $row['designation']; ?></option>
                        <option value="CEO">CEO</option>
                        <option value="CFO">CFO</option>
                        <option value="GM">GM</option>
                        <option value="DGM">DGM</option>
                        <option value="Dept. Manager">Dept. Manager</option>
                        <option value="Auditor ">Auditor </option>
                        <option value="Sr. IT Officer">Sr. IT Officer</option>
                        <option value="Jr. IT Officer">Jr. IT Officer</option>
                        <option value="Driver">Driver</option>
                        <option value="GUARD">GUARD</option>
                        <option value="Sr. Soft Dev">Sr. Soft Dev</option>
                        <option value="Jr. Soft Dev">Jr. Soft Dev</option>
                        <option value="Recruitment Manager">Recruitment Manager</option>
                        <option value="Jr. Recruiter">Jr. Recruiter</option>
                        <option value="Sr. Recruiter">Sr. Recruiter</option>
                        <option value="Stuff">Stuff</option>
                        <option value="Marketing Manager">Marketing Manager</option>
                        <option value="Sr. Web Master">Sr. Web Master</option>
                        <option value="Jr. Web Master">Jr. Web Master</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Address</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="Address" value="<?php echo $row['Address']; ?>" placeholder="<?php echo $row['Address']; ?>">

                </div>

                <div>
                    <label for="exampleInputEmail1">Department</label>
                    <select class="form-control" name="department" required>
                        <option selected><?php echo $row['department']; ?></option>
                        <option value="Management">Management</option>
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
