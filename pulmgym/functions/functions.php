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
    $sql = "SELECT id FROM users WHERE email = '$email'";
    $result = query($sql);

    if(row_count($result) == 1){
        return true;
    }
    else {
        return false;
    }

}

function username_exists($username) {
    $sql = "SELECT id FROM users WHERE username = '$username'";
    $result = query($sql);

    if(row_count($result) == 1){
        return true;
    }
    else {
        return false;
    }
}

function item_exists($name) {
    $sql = "SELECT id FROM items WHERE name = '$name'";
    $result = query($sql);

    if(row_count($result) == 1){
        return true;
    }
    else {
        return false;
    }
}

function send_email($email, $subject, $msg, $headers) {

    return mail($email, $subject, $msg, $headers);

}





/************************ Validate User Registration **************************/

function validate_user_registration() {


    $errors = [];
    $min = 3;
    $max = 20;

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $first_name = clean($_POST['first_name']);
        $last_name = clean($_POST['last_name']);
        $username = clean($_POST['username']);
        $email = clean($_POST['email']);
        $password = clean($_POST['password']);
        $confirm_password = clean($_POST['confirm_password']);



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

        if(username_exists($username)) {
            $errors[] = "Sorry that username is already registered";
        }

        if(strlen($username) < $min) {
            $errors[] = "Your username can not be less than {$min} characters";
        }

        if(strlen($username) > $max) {
            $errors[] = "Your username can not be less than {$max} characters";
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
            if(register_user($first_name, $last_name, $username, $email, $password)) {
                // set_message();
                // $message ="Registration Successful";
                // echo display_warning_message($message);
                set_message("<p class='bg-success text-center'>Please check your email</p>");
                redirect("login.php");
            }
            else {
                set_message("<p class='bg-danger text-center'>Operation Failed</p>");
                redirect("register.php");
            }
        }
    }
}




/************************  User Registration Function  **************************/

function register_user($first_name, $last_name, $username, $email, $password) {

    $first_name = escape($first_name);
    $last_name  = escape($last_name);
    $username   = escape($username);
    $email      = escape($email);
    $password   = escape($password);



    if(email_exists($email)){
        return false;
    }
    elseif (username_exists($username)) {
        return false;
    }
    else {

        $password = md5($password);
        @$validation_code = md5($username + microtime());

        $sql = "INSERT INTO users(first_name, last_name, username, email, password, validation_code, active)";
        $sql.= " VALUES('$first_name', '$last_name', '$username', '$email', '$password', '$validation_code', 0)";

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
        $username = clean($_POST['username']);
        $email = clean($_POST['email']);
        //$password = clean($_POST['password']);
        //$confirm_password = clean($_POST['confirm_password']);
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

        if(strlen($username) < $min) {
            $errors[] = "Your username can not be less than {$min} characters";
        }

        if(strlen($username) > $max) {
            $errors[] = "Your username can not be less than {$max} characters";
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
            if(update_user($id, $first_name, $last_name, $username, $email, $active)) {
                // set_message();
                // $message ="Registration Successful";
                // echo display_warning_message($message);
                set_message("<p style='margin-top: -20px;' class='bg-success text-center'>Update Successful</p>");
                redirect("update.php");
            }
            else {
                set_message("<p class='bg-danger text-center'>Operation Failed</p>");
                redirect("update.php");
            }
        }
    }
}




/************************  User Update Function  **************************/

function update_user($id, $first_name, $last_name, $username, $email, $active) {

    $first_name = escape($first_name);
    $last_name  = escape($last_name);
    $username   = escape($username);
    $email      = escape($email);
    $active     = escape($active);
    $check = 0;


        //$password = md5($password);
        //@$validation_code = md5($username + microtime());

        $sql1 =  "UPDATE users SET first_name = '$first_name' WHERE id = $id";
        $sql2 =  "UPDATE users SET last_name = '$last_name' WHERE id = $id";
        $sql3 =  "UPDATE users SET username = '$username' WHERE id = $id";
        $sql4 =  "UPDATE users SET email = '$email' WHERE id = $id";
        $sql5 =  "UPDATE users SET active = '$active' WHERE id = $id";



        $result = query($sql1);
        if(confirm($result)) $check ++;

        $result = query($sql2);
        if(confirm($result)) $check ++;

        $result = query($sql3);
        if(confirm($result)) $check ++;

        $result = query($sql4);
        if(confirm($result)) $check ++;

        $result = query($sql5);
        if(confirm($result)) $check ++;

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
        $username = clean($_POST['username']);
        $email = clean($_POST['email']);
        $password = clean($_POST['password']);
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

        if(username_exists($username)) {
            $errors[] = "Sorry that username is already registered";
        }

        if(strlen($username) < $min) {
            $errors[] = "Your username can not be less than {$min} characters";
        }

        if(strlen($username) > $max) {
            $errors[] = "Your username can not be less than {$max} characters";
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
            if(insert_user($first_name, $last_name, $username, $email, $password, $active)) {
                // set_message();
                // $message ="Registration Successful";
                // echo display_warning_message($message);
                set_message("<p class='bg-success text-center'>Insertion Successful</p>");
                redirect("insert.php");
            }
            else {
                set_message("<p class='bg-danger text-center'>Operation Failed</p>");
                redirect("insert.php");
            }
        }
    }
}




/************************  User insertion Function  **************************/

function insert_user($first_name, $last_name, $username, $email, $password, $active) {

    $first_name = escape($first_name);
    $last_name  = escape($last_name);
    $username   = escape($username);
    $email      = escape($email);
    $password   = escape($password);
    $active     = escape($active);



    if(email_exists($email)){
        return false;
    }
    elseif (username_exists($username)) {
        return false;
    }
    else {

        $password = md5($password);
        @$validation_code = md5($username + microtime());

        $sql = "INSERT INTO users(first_name, last_name, username, email, password, validation_code, active)";
        $sql.= " VALUES('$first_name', '$last_name', '$username', '$email', '$password', '$validation_code', '$active')";

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

            $sql = "SELECT id FROM users WHERE email = '".escape($_GET['email'])."'  AND validation_code = '".escape($_GET['code'])."' ";
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
                redirect("user.php");
            }
            elseif(login_Admin($email, $password, $remember, $roll)){
                $id = login_Admin($email, $password, $remember, $roll);
                $_SESSION['id'] = $id;
                redirect("adminHome.php");
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

    $sql = "SELECT password, id, r_oll FROM users WHERE email = '".escape($email)."' AND r_oll = 9";
    $result = query($sql);

    if(row_count($result) == 1) {

        $row = fetch_array($result);
        $db_password = $row['password'];
        $db_roll = $row['r_oll'];
        $db_id = $row['id'];

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

    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = query($sql);

    if(row_count($result) == 1) {

        $row = fetch_array($result);
        $db_id = $row['id'];

        $_SESSION['userAdmin'] = $id;

        return $db_id;
    }
    else {
        return false;
    }
}



/************************ User Login Function **************************/

function login_user($email, $password, $remember) {

    $sql = "SELECT password, id, r_oll FROM users WHERE email = '".escape($email)."' AND active = 1 AND r_oll != 9";
    $result = query($sql);

    if(row_count($result) == 1) {

        $row = fetch_array($result);
        $db_password = $row['password'];
        $db_id = $row['id'];


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




/************************ Warning Message **************************/

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




/************************ item insertion **************************/

function validate_item_insertion() {


    $errors = [];

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $name = clean($_POST['name']);
        $description = clean($_POST['description']);



        if(item_exists($name)) {
            $errors[] = "Sorry that item already exists";
        }

        if(!empty($errors)) {
            foreach ($errors as $error){
                echo display_warning_message($error);
            }
        }
        else {
            if(insert_item($name, $description)) {
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

function insert_item($name, $description) {

    $name = escape($name);
    $description  = escape($description);



    if(item_exists($name)){
        return false;
    }
    else {

        $sql = "INSERT INTO items(name, description)";
        $sql.= " VALUES('$name', '$description')";

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




/************************ Validate User Update **************************/

function validate_item_update($id) {

    $errors = [];

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $name = clean($_POST['name']);
        $description = clean($_POST['description']);

        if(!empty($errors)) {
            foreach ($errors as $error){
                echo display_warning_message($error);
            }
        }
        else {
            if(update_item($id, $name, $description)) {
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




/************************  User Update Function  **************************/

function update_item($id, $name, $description) {

    $name = escape($name);
    $description  = escape($description);
    $check = 0;


    $sql1 =  "UPDATE items SET name = '$name' WHERE id = $id";
    $sql2 =  "UPDATE items SET description = '$description' WHERE id = $id";


    $result = query($sql1);
    if(confirm($result)) $check ++;

    $result = query($sql2);
    if(confirm($result)) $check ++;


    return true;

}





/************************ Warning Message **************************/

function display_warning_message($message) {

$message = <<<DELIMITER

<div class="alert alert-warning alert-dismissible" role="alert">
    <strong>Message! </strong>  $message  
    <button type="button" class"close" data-dismiss="alert" aria-label="Close" style="display: none;">
    <span aria-hidden="true">&times;</span>
    </button>
</div>                

DELIMITER;

    
return $message;

}
