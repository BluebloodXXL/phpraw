<?php include("includes/header.php") ?>

    <?php include ("includes/nav.php") ?>


    <div class="jumbotron">
        <?php echo display_message(); ?>
        <h1 class="text-center"> HOME </h1>
    </div>

    <?php

        $sql = "SELECT * FROM users";
        $result = query($sql);
        confirm($result);
        $row = fetch_array($result);

        //foreach ($row as $out)
            //echo $out['username'];
    ?>


<?php include ("includes/footer.php") ?>