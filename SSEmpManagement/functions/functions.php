<?php
/**
 * Created by PhpStorm.
 * User: duke90
 * Date: 1/8/2019
 * Time: 3:45 AM
 */

function clean($string){
    return htmlentities($string);
}

function redirect($location){
    return header("Location: {$location}");
}

function set_message($message) {
    if(!empty($message)) {
        $_SESSION['message'] = $message;
    }
    else {
        $message = "";
    }
}

function display_message() {
    if(isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

function token_generator() {
    $token = $_SESSION['token'] = md5(uniqid(mt_rand(), true));
    return $token;
}

function email_exists($email) {
    $sql = "SELECT idU FROM users WHERE email = '$email'";
    $result = query($sql);

    if(row_count($result) == 1){
        return true;
    }
    else {
        return false;
    }

}

function send_email($email, $subject, $msg, $headers) {

    return @mail($email, $subject, $msg, $headers);

}





/************************ Validate User Registration **************************/

function validate_user_registration() {


    $errors = [];
    $min = 3;
    $max = 20;

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $first_name = clean($_POST['first_name']);
        $last_name = clean($_POST['last_name']);
        $email = clean($_POST['email']);
        $password = clean($_POST['password']);
        $confirm_password = clean($_POST['confirm_password']);
        $department = clean($_POST['department']);
        $designation = clean($_POST['designation']);
        $address = clean($_POST['Address']);



        if(strlen($first_name) < $min) {
            $errors[] = "Your first name can not be less than {$min} characters";
        }

        if(strlen($first_name) > $max) {
            $errors[] = "Your first name can not be more than {$max} characters";
        }

        if(strlen($last_name) < $min) {
            $errors[] = "Your last name can not be less than {$min} characters";
        }

        if(strlen($last_name) > $max) {
            $errors[] = "Your last name can not be less than {$max} characters";
        }
        if(email_exists($email)) {
            $errors[] = "Sorry that email is already registered";
        }
        if(strlen($email) > ($max+20)) {
            $errors[] = "Your email can not be more than {($max+20)} characters";
        }
        if($password !== $confirm_password) {
            $errors[] = "Re-entered password is wrong!";
        }
        if(!empty($errors)) {
            foreach ($errors as $error){
                echo display_warning_message($error);
            }
        }
        else {
            if(register_user($first_name, $last_name, $email, $password, $department, $designation, $address)) {
                // set_message();
                // $message ="Registration Successful";
                // echo display_warning_message($message);
                echo display_warning_message("Registration is successful, check Email.");
            }
            else {

                echo display_warning_message("Registration is not successful.");
            }
        }
    }
}




/************************  User Registration Function  **************************/

function register_user($first_name, $last_name, $email, $password, $department, $designation, $address) {

    $first_name     = escape($first_name);
    $last_name      = escape($last_name);
    $email          = escape($email);
    $password       = escape($password);
    $department     = escape($department);
    $designation    = escape($designation);
    $address        = escape($address);



    if(email_exists($email)){
        return false;
    }
    else {

        $password = md5($password);
        @$validation_code = md5($first_name + microtime());

        $sql = "INSERT INTO users(first_name, last_name, email, password, validation_code, active, Address, designation, department)";
        $sql.= " VALUES('$first_name', '$last_name', '$email', '$password', '$validation_code', 0, '$address', '$designation', '$department')";

        $result = query($sql);
        confirm($result);

        //echo "User registered!";

        $subject = "Activate Account";
        $msg = " Please click the link below to activate your Account.
                 http://localhost/login/activate.php?email=$email&code=$validation_code ";
        $headers = "From: noreply@youtwebsite.com";


        send_email($email, $subject, $msg, $headers);

        return true;

    }

}




/************************ Validate User Update **************************/

function validate_user_update($id) {

    $errors = [];
    $min = 3;
    $max = 20;

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $first_name = clean($_POST['first_name']);
        $last_name = clean($_POST['last_name']);
        $email = clean($_POST['email']);
        $department = clean($_POST['department']);
        $designation = clean($_POST['designation']);
        $address = clean($_POST['Address']);
        $active = clean($_POST['active']);

        if(strlen($first_name) < $min) {
            $errors[] = "Your first name can not be less than {$min} characters";
        }

        if(strlen($first_name) > $max) {
            $errors[] = "Your first name can not be more than {$max} characters";
        }

        if(strlen($last_name) < $min) {
            $errors[] = "Your last name can not be less than {$min} characters";
        }

        if(strlen($last_name) > $max) {
            $errors[] = "Your last name can not be less than {$max} characters";
        }

        if(strlen($email) > ($max+20)) {
            $errors[] = "Your email can not be more than {($max+20)} characters";
        }

        if(!empty($errors)) {
            foreach ($errors as $error){
                echo display_warning_message($error);
            }
        }
        else {
            if(update_user($id, $first_name, $last_name, $email, $active, $address, $designation, $department)) {
                // set_message();
                // $message ="Registration Successful";
                // echo display_warning_message($message);
                set_message("<p style='margin-top: -20px;' class='bg-success text-center'>Update Successful</p>");
                redirect("employee.php");
            }
            else {
                set_message("<p class='bg-danger text-center'>Operation Failed</p>");
                redirect("employee.php");
            }
        }
    }
}




/************************  User Update Function  **************************/

function update_user($id, $first_name, $last_name, $email, $active, $address, $designation, $department) {

    $first_name = escape($first_name);
    $last_name  = escape($last_name);
    $email      = escape($email);
    $active     = escape($active);
    $address = escape($address);
    $designation = escape($designation);
    $department = escape($department);
    $check = 0;


        //$password = md5($password);
        //@$validation_code = md5($username + microtime());

        $sql1 =  "UPDATE users SET first_name = '$first_name' WHERE idU = $id";
        $sql2 =  "UPDATE users SET last_name = '$last_name' WHERE idU = $id";
        $sql3 =  "UPDATE users SET email = '$email' WHERE idU = $id";
        $sql4 =  "UPDATE users SET active = '$active' WHERE idU = $id";
        $sql5 =  "UPDATE users SET Address = '$address' WHERE idU = $id";
        $sql6 =  "UPDATE users SET department = '$department' WHERE idU = $id";
        $sql7 =  "UPDATE users SET designation = '$designation' WHERE idU = $id";


        $result = query($sql1);
        (confirm($result));

        $result = query($sql2);
        (confirm($result));

        $result = query($sql3);
        (confirm($result));

        $result = query($sql4);
        (confirm($result));

        $result = query($sql5);
        (confirm($result));

        $result = query($sql6);
        (confirm($result));

        $result = query($sql7);
        (confirm($result));

        /*
        echo "User registered!";

        $subject = "Activate Account";
        $msg = " Please click the link below to activate your Account.
                 http://localhost/login/activate.php?email=$email&code=$validation_code ";
        $headers = "From: noreply@youtwebsite.com";


        send_email($email, $subject, $msg, $headers);
        */
        return true;
}




/************************ Validate User insertion **************************/

function validate_user_insertion() {


    $errors = [];
    $min = 3;
    $max = 20;

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $first_name = clean($_POST['first_name']);
        $last_name = clean($_POST['last_name']);
        $email = clean($_POST['email']);
        $password = clean($_POST['password']);
        $department = clean($_POST['department']);
        $designation = clean($_POST['designation']);
        $address = clean($_POST['Address']);
        $confirm_password = clean($_POST['confirm_password']);
        $active = clean($_POST['active']);


        if(strlen($first_name) < $min) {
            $errors[] = "Your first name can not be less than {$min} characters";
        }

        if(strlen($first_name) > $max) {
            $errors[] = "Your first name can not be more than {$max} characters";
        }

        if(strlen($last_name) < $min) {
            $errors[] = "Your last name can not be less than {$min} characters";
        }

        if(strlen($last_name) > $max) {
            $errors[] = "Your last name can not be less than {$max} characters";
        }

        if(email_exists($email)) {
            $errors[] = "Sorry that email is already registered";
        }

        if(strlen($email) > ($max+20)) {
            $errors[] = "Your email can not be more than {($max+20)} characters";
        }

        if($password !== $confirm_password) {
            $errors[] = "Re-entered password is wrong!";
        }

        if(!empty($errors)) {
            foreach ($errors as $error){
                echo display_warning_message($error);
            }
        }
        else {
            if(insert_user($first_name, $last_name, $email, $password, $department, $designation, $address , $active)) {
                // set_message();
                // $message ="Registration Successful";
                // echo display_warning_message($message);
                display_warning_message("Successful");
            }
            else {
                display_warning_message("Unsuccessful");
            }
        }
    }
}




/************************  User insertion Function  **************************/

function insert_user($first_name, $last_name, $email, $password, $department, $designation, $address , $active) {

    $first_name = escape($first_name);
    $last_name = escape($last_name);
    $email = escape($email);
    $password = escape($password);
    $department = escape($department);
    $designation = escape($designation);
    $address = escape($address);
    $active = escape($active);



    if(email_exists($email)){
        return false;
    }
    else {

        $password = md5($password);
        @$validation_code = md5($first_name + microtime());

        $sql = "INSERT INTO users(first_name, last_name, email, password, validation_code, active, department, designation, Address)";
        $sql.= " VALUES('$first_name', '$last_name', '$email', '$password', '$validation_code', '$active', '$department', '$designation', '$address')";

        $result = query($sql);
        confirm($result);

        /*
        echo "User registered!";

        $subject = "Activate Account";
        $msg = " Please click the link below to activate your Account.
                 http://localhost/login/activate.php?email=$email&code=$validation_code ";
        $headers = "From: noreply@youtwebsite.com";


        send_email($email, $subject, $msg, $headers);
        */

        return true;

    }

}




/************************  Activate User  **************************/

function activate_user() {
    if($_SERVER['REQUEST_METHOD'] == "GET") {
        if(isset($_GET['email'])) {
            $email = clean($_GET['email']);
            $validation_code = clean($_GET['code']);

            $sql = "SELECT idU FROM users WHERE email = '".escape($_GET['email'])."'  AND validation_code = '".escape($_GET['code'])."' ";
            $resultSelect = query($sql);
            confirm($resultSelect);

            if(row_count($resultSelect) == 1) {

                $sqlInsert = "UPDATE users SET active = 1, validation_code = 0 WHERE email = '".escape($email)."' AND validation_code = '".escape($validation_code)."'  ";

                $resultInsert = query($sqlInsert);
                confirm($resultInsert);

                set_message("<p class= 'bg-success'>Your account has been activated please login</p>");

                redirect("login.php");
            }
            else {
                set_message("<p class= 'bg-danger'>Your account has not been activated yet</p>");

                redirect("login.php");
            }
        }
    }
}




/************************ Validate User login functionality **************************/

function validate_user_login() {
    $errors = [];


    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $email    = clean($_POST['email']);
        $password = clean($_POST['password']);
        $remember = isset($_POST['remember']);
        $roll = 9;



        if(empty($email)){
            $errors[] = "Email field can not be empty";
        }

        if(empty($password)) {
            $errors[] = "Password field can not be empty";
        }

        if(!empty($errors)) {
            foreach ($errors as $error){
                echo display_warning_message($error);
            }
        }
        else {
            if(login_user($email, $password, $remember)) {
                $id = login_user($email, $password, $remember);
                $_SESSION['id'] = $id;
                redirect("home.php");
            }
            elseif(login_Admin($email, $password, $remember, $roll)){
                $id = login_Admin($email, $password, $remember, $roll);
                $_SESSION['id'] = $id;
                redirect("admin.php");
            }
            else {
                $msg = "Credentials don't match";
                echo display_warning_message($msg);
            }
        }
    }
}




/************************ Admin Login Session set Function **************************/

function login_Admin($email, $password, $remember, $roll) {

    $sql = "SELECT password, idU, r_oll FROM users WHERE email = '".escape($email)."' AND r_oll = 9";
    $result = query($sql);

    if(row_count($result) == 1) {

        $row = fetch_array($result);
        $db_password = $row['password'];
        $db_roll = $row['r_oll'];
        $db_id = $row['idU'];

        if((md5($password) === $db_password) && $db_roll == $roll) {

            //idSet::$userID = $db_id;

            if($remember == "on") {
                setcookie("email", $email, time() + 86000);
            }

            $_SESSION['admin'] = $email;

            return $db_id;
             //return true;
        }
        else {
            return false;
        }
        return $db_id;
        //return true;
    }
    else {
        return false;
    }
}



/************************ User from Admin Login Function **************************/

function login_user4mAdmin($id) {

    $sql = "SELECT * FROM users WHERE idU = '$id'";
    $result = query($sql);

    if(row_count($result) == 1) {

        $row = fetch_array($result);
        $db_id = $row['idU'];

        $_SESSION['userAdmin'] = $id;

        return $db_id;
    }
    else {
        return false;
    }
}



/************************ User Login Function **************************/

function login_user($email, $password, $remember) {

    $sql = "SELECT password, idU, r_oll FROM users WHERE email = '".escape($email)."' AND active = 1 AND r_oll != 9";
    $result = query($sql);

    if(row_count($result) == 1) {

        $row = fetch_array($result);
        $db_password = $row['password'];
        $db_id = $row['idU'];


        if(md5($password) === $db_password) {

            //idSet::$userID = $db_id;

            if($remember == "on") {
                setcookie("email", $email, time() + 86000);
            }

            $_SESSION['email'] = $email;
            return $db_id;
            //return true;
        }
        else {
            return false;
        }
        return $db_id;
        //return true;
    }
    else {
        return false;
    }
}




/************************ Login Session Function **************************/

function logged_in() {
    if(isset($_SESSION['email']) || isset($_COOKIE['email'])) {
        return true;
    }
    else {
        return false;
    }
}




/************************ Admin Login Function **************************/

function logged_in_Admin() {
    if(isset($_SESSION['admin']) || isset($_COOKIE['admin'])) {
        return true;
    }
    else {
        return false;
    }
}




/************************ recover password **************************/

function recover_password() {
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        if(isset($_SESSION['token']) && $_POST['token'] === $_SESSION['token']) {
            $email = clean($_POST['email']);
            if(email_exists($email)) {

                @$validation_code = md5($email + microtime());

                setcookie('temp_access_code', $validation_code, time() + 900);

                $sql = "UPDATE users SET validation_code = '".escape($validation_code)."' WHERE email = '".escape($email)."'";
                $result = query($sql);
                confirm($result);

                $subject = "Please reset your password";
                $message = "Here is your password rest code {$validation_code}
                Click here to reset your password http://localhost/code.php?email=$email&code=$validation_code";

                $headers = "From: noreply@yourwebsite.com";

                if(!(@send_email($email, $subject, $message, $headers))) {
                    echo display_warning_message("Email is not sent");
                }
                set_message("<p class='bg-success text-center'>Please check your email or spam folder for validation code. </p>");
                redirect("index.php");
            }
            else {
                echo display_warning_message("This email does not exit");
            }
        }
        else {
            redirect("index.php");
        }
        if(isset($_POST['cancel_submit'])) {
            redirect("login.php");

        }
    }
}




/************************ Code Validation **************************/

function validate_code() {

    if(isset($_COOKIE['temp_access_code'])) {
        if(!isset($_GET['email']) && !isset($_GET['code'])) {
            redirect("index.php");
        }
        elseif (empty($_GET['email']) || empty($_GET['code'])) {
            redirect("index.php");
        }
        else {
            if(isset($_POST['code'])) {
                $email = clean($_GET['email']);
                $validation_code = clean($_POST['code']);
                $sql = "SELECT id FROM users WHERE validation_code = '".escape($validation_code)."' AND email = '".escape($email)."' ";
                $result = query($sql);
                confirm($result);

                if(row_count($result) == 1) {
                    setcookie('temp_access_code', $validation_code, time() + 300);
                    redirect("reset.php?email=$email&code=$validation_code");
                }
                else {
                    echo display_warning_message("Sorry wrong validation code !");
                }
            }
        }
    }
    else {

        set_message("<p class='bg-danger text-center'>Time has been expired ! </p>");
        redirect("recover.php");
    }
}




/************************ Password Reset **************************/

function password_reset() {
    if(isset($_COOKIE['temp_access_code'])) {
        if (isset($_GET['email']) && isset($_GET['code'])) {
            if(isset($_SESSION['token']) && isset($_POST['token']) && ($_POST['token']) === ($_SESSION['token'])) {
                if($_POST['password'] === $_POST['confirm_password']) {
                    $updated_password = md5($_POST['password']);
                    $sql = "UPDATE users SET password = '".escape($updated_password)."', validation_code = 0  WHERE email = '".escape($_GET['email'])."'";
                    $result = query($sql);
                    confirm($result);

                    set_message("<p class='bg-success text-center'>Password updated !</p>");
                    redirect("login.php");
                }
            }
        }
    }
    else {
        set_message("<p class='bg-danger text-center'>Time has been expired !</p>");
        redirect("recover.php");
    }
}




/************************ post insertion **************************/

function validate_post_insertion() {


    $errors = [];

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $title = clean($_POST['title']);
        $description = clean($_POST['description']);



        if(item_exists($title)) {
            $errors[] = "Sorry that item already exists";
        }

        if(!empty($errors)) {
            foreach ($errors as $error){
                echo display_warning_message($error);
            }
        }
        else {
            if(insert_item($title, $description)) {
                // set_message();
                // $message ="Registration Successful";
                // echo display_warning_message($message);
                set_message("<p class='bg-success text-center'>Insertion Successful</p>");
                redirect("insertItem.php");
            }
            else {
                set_message("<p class='bg-danger text-center'>Operation Failed</p>");
                redirect("insertItem.php");
            }
        }
    }
}




/************************  item insertion Function  **************************/

function insert_post($title, $description) {

    $name = escape($title);
    $description  = escape($description);



    $sql = "INSERT INTO posts(title, description)";
    $sql.= " VALUES('$title', '$description')";

    $result = query($sql);
    confirm($result);

        /*
        echo "User registered!";

        $subject = "Activate Account";
        $msg = " Please click the link below to activate your Account.
                 http://localhost/login/activate.php?email=$email&code=$validation_code ";
        $headers = "From: noreply@youtwebsite.com";


        send_email($email, $subject, $msg, $headers);
        */

    return true;



}




/************************ Validate Post Update **************************/

function validate_post_update($id) {

    $errors = [];

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $title = clean($_POST['title']);
        $description = clean($_POST['description']);

        if(!empty($errors)) {
            foreach ($errors as $error){
                echo display_warning_message($error);
            }
        }
        else {
            if(update_item($id, $title, $description)) {
                set_message("<p style='margin-top: -20px;' class='bg-success text-center'>Update Successful</p>");
                redirect("updateItem.php");
            }
            else {
                set_message("<p class='bg-danger text-center'>Operation Failed</p>");
                redirect("updateItem.php");
            }
        }
    }
}




/************************  Post Update Function  **************************/

function update_item($id, $title, $description) {

    $name = escape($title);
    $description  = escape($description);
    $check = 0;


    $sql1 =  "UPDATE posts SET title = '$title' WHERE id = $id";
    $sql2 =  "UPDATE posts SET description = '$description' WHERE id = $id";


    $result = query($sql1);
    if(confirm($result)) $check ++;

    $result = query($sql2);
    if(confirm($result)) $check ++;


    return true;

}





/************************ Warning Message **************************/

function display_warning_message($message) {

$message = <<<DELIMITER

<div class="alert alert-warning alert-dismissible text-center" style="padding-left: 20px; padding-right: auto;" role="alert">
    <strong>Message! </strong>  $message  
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="display: none;">
    <span >&times;</span>
    </button>
</div>                

DELIMITER;

    
return $message;

}
