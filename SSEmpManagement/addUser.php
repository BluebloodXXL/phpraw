<?php include("includes/header.php");
if (logged_in_Admin())
    validate_user_insertion();
else
    redirect("middleware.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SSEnterpriseReg</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
</head>
<body>


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
                <li class="nav-item active">
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


<div class="limiter">
    <div class="container-login100" >
        <div class="wrap-login100">
            <form class="login100-form validate-form p-l-55 p-r-55 p-t-178" method="POST">
					<span class="login100-form-title">
						Sign UP
					</span>

                <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter email">
                    <input class="input100" type="email" name="email" placeholder="email" required>
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter First name">
                    <input class="input100" type="text" name="first_name" placeholder="First name" required>
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter Last name">
                    <input class="input100" type="text" name="last_name" placeholder="Last name" required>
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter Designation">
                    <select class="input100" name="designation" required>
                        <option selected disabled value="">Select Designation</option>
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

                <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter Address">
                    <input class="input100" type="text" name="Address" placeholder="Address" required>
                    <span class="focus-input100"></span>
                </div>

                <!--
                <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter Address">
                    <input class="input100" type="text" name="active" placeholder="0 for inactive 1 for active" required>
                    <span class="focus-input100"></span>
                </div>
                -->

                <div class="wrap-input100 validate-input m-b-16" data-validate="active or inactive">
                    <!--<input class="input100" type="text" name="department" placeholder="Department">
                    <span class="focus-input100"></span>-->
                    <select class="input100" name="active">
                        <option disabled selected>Select account status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Please enter password">
                    <input class="input100" type="password" name="password" placeholder="Password" required>
                    <span class="focus-input100"></span>
                </div>

                <br>

                <div class="wrap-input100 validate-input" data-validate = "Please enter password">
                    <input class="input100" type="password" name="confirm_password" placeholder="Password" required>
                    <span class="focus-input100"></span>
                </div>

                <br>

                <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter Department">
                    <!--<input class="input100" type="text" name="department" placeholder="Department">
                    <span class="focus-input100"></span>-->
                    <select class="input100" name="department" required>
                        <option selected disabled value="">Select Department</option>
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




                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" type="submit" name="submit">
                        Sign Up
                    </button>
                </div>

                <br>


            </form>
        </div>
    </div>
</div>


<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/daterangepicker/moment.min.js"></script>
<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="js/main.js"></script>

</body>
</html>
