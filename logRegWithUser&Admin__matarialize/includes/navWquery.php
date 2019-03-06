<nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Logo</a>
        <ul class="right hide-on-med-and-down">
            <li><a href="index.php">Navbar Link</a></li>
            <?php if(!logged_in()) { ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Registration</a></li>
            <?php } ?>
            <?php if(logged_in()) { ?>
                <li><a href="logout.php">Logout</a></li>
            <?php } ?>
        </ul>

        <ul id="nav-mobile" class="sidenav">
            <li><a href="#">Navbar Link</a></li>
            <?php if(!logged_in()) { ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Registration</a></li>
            <?php } ?>
            <?php if(logged_in()) { ?>
                <li><a href="logout.php">Logout</a></li>
            <?php } ?>
        </ul>
        <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
</nav>