<?php include("includes/headerWOcontainer.php") ?>
<?php include ("includes/nav.php") ?>


    <div class="jumbotron">
        <?php echo display_message(); ?>
        <h1 class="text-center"> Index Site Cover Page </h1>
    </div>
    <div class="container">

    <?php

        $sql = "SELECT * FROM items";
        $result = query($sql);
        confirm($result);
        if(row_count($result)) {
            $row = fetch_array($result);


























        }

        //foreach ($row as $out)
            //echo $out['username'];
    ?>


<?php include ("includes/footer.php") ?>