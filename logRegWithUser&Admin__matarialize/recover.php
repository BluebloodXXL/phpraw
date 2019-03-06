<?php include("includes/headerUC.php") ?>
<?php if (logged_in())
    redirect("overLogin.php");
?>


    <body>

<?php include ("includes/navWquery.php"); ?>

<div class="">

    <div class="row right">
        <?php recover_password(); ?>
    </div>

    <div class="section container" id="index-banner">

        <div class="row">

            <div class="logCard col l6 s12 offset-l3 " style="padding-top: 10%;">


                <div class="row">
                    <div class="col s12">
                        <div class="card blue-grey darken-1">
                            <div class="card-content white-text">
                                <span class="card-title center">Recover Password</span>

                                <form class="" id="active_form" method="post" role="form">

                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input name="email" id="email" type="email" class="validate" placeholder="">
                                            <label for="email">Email</label>
                                        </div>
                                    </div>

                                    <div class="row center">
                                        <div class="input-field col s6">
                                            <button class="btn waves-effect waves-red light-blue" type="submit" name="cancel_submit">Cancel
                                                <i class="material-icons right">cancel</i>
                                            </button>
                                        </div>
                                        <div class="input-field col s6">
                                            <button class="btn waves-effect waves-red light-green" type="submit" name="recover-submit">Submit
                                                <i class="material-icons right">send</i>
                                            </button>
                                        </div>
                                    </div>

                                    <input type="hidden" class="hide" name="token" id="token" value="<?php echo token_generator(); ?>">


                                </form>

                                <div class="row center">
                                    <?php display_message(); ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include ("includes/footerWbC.php"); ?>