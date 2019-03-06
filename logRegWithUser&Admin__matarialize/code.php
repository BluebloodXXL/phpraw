<?php include("includes/headerUC.php") ?>
<?php if (logged_in())
    redirect("overLogin.php");
?>


<body>

<?php include ("includes/navWquery.php"); ?>

<div class="">
    <div class="section container" id="index-banner">

        <div class="row">

            <div class="logCard col l6 s12 offset-l3 " style="padding-top: 10%;">


                <div class="row">
                    <div class="col s12">
                        <div class="card blue-grey darken-1">
                            <div class="card-content white-text">
                                <span class="card-title center">Please enter the code</span>

                                <form class="" id="active_form" method="post" role="form">

                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input name="code" id="code" type="text" class="validate" placeholder="#########################" required>
                                            <label for="code">Activation Code</label>
                                        </div>
                                    </div>

                                    <div class="row center">
                                        <div class="input-field col s12">
                                            <button class="btn waves-effect waves-red orange" type="submit" name="code-submit">Submit
                                                <i class="material-icons right">send</i>
                                            </button>
                                        </div>
                                    </div>

                                    <input type="hidden" class="hide" name="token" id="token" value="">

                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php display_message(); ?>
<?php validate_code(); ?>

<?php include ("includes/footerWbC.php"); ?>