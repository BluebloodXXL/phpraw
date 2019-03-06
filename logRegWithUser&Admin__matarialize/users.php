<?php include("includes/headerUC.php"); ?>

<?php
if(!logged_in())
    redirect("middleware.php");

if(isset($_SESSION['admin'])) {
    redirect("admin.php");
}
elseif (isset($_SESSION['email'])){
    $email = $_SESSION['email'];

    $sql = "select r_oll from users where email = '$email'";
    $result = query($sql);

    if (row_count($result) == 1) {
        $row = fetch_array($result);
    }

}