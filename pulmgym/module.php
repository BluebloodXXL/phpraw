<?php include("includes/headerWOcontainer.php") ?>
<?php include ("includes/nav.php");


echo display_message();
if(logged_in()){
    redirect("user.php");
}
elseif (logged_in_Admin())
    redirect("readItem.php");


$conn = new mysqli('localhost', 'root', '', 'login_db');

if ($conn) {
    //echo "Connection successful";
} else {
    error . mysqli_connect_error();
    //error.mysql_connect();
}

$sql = "select * from items";
$result = mysqli_query($conn, $sql);

?>
        <h1 style="padding-bottom: 30px;" class="text-center">Modules of Training</h1>
    </div>
    <div class="container">

<?php

//$sql = "SELECT * FROM items";
//$result = query($sql);
//confirm($result);
if ($result->num_rows) {
    //$row = fetch_array($result); ?>

    <div class="row">
    <?php

    while ($alldata = mysqli_fetch_array($result)) {

        ?>

        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <div class="caption">
                    <h3><?php echo $alldata['name']; ?></h3>
                    <p class="card-text"><?php echo $alldata['description']; ?></p>
                    <a href="login.php" class="btn btn-primary">Subscribe</a>

                </div>
            </div>
        </div>

        <?php

    }
    ?>
    </div>
        <?php
        }
        else {
            echo "<h2 style='color: red;' class='text-center'>No Result Found !</h2>";
        }

        ?>

        <!--
                </table>
            </div>
        -->

<?php include ("includes/footer.php") ?>