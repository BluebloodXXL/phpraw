<?php include("includes/headerWOcontainer.php") ?>
<?php include("includes/nav.php") ?>


<?php

if (logged_in_Admin()) {
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        // $email = $_COOKIE['email'];
        $sql = "SELECT * FROM users WHERE id = '$id'";
        $result = query($sql);

        if (row_count($result) > 0) {
            $row = fetch_array($result);

            echo
                "<div class='jumbotron' style='background-color: black; color: snow; height: 115px; padding-bottom: 20px; margin-top: -40px; '>
            <div class='container'>
                <div class='row'>
                    <div class='col-lg-12'>
                        <h1 style='margin-top: -25px;' class='text-center'>Welcome " . $row['first_name'] ."</h1>
                    </div>
                </div>
            </div>
          </div>
          <div class='container'>";
        }
    }
} else {
    redirect("index.php");
}
?>
</h1>
</div>


<?php include("includes/footer.php") ?>
