<?php include ("functions/init.php"); ?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Grayscale - Start Bootstrap Theme</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/grayscale.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">pulmGym</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#projects">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#signup">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="module.php">Module</a>
          </li>

          <?php if(logged_in() || logged_in_Admin()) { ?>

              <li class="nav-item">
                <a class="nav-link " href="logout.php">logout</a>
              </li>

          <?php } else { ?>

              <li class="nav-item">
                <a class="nav-link " href="login.php">login</a>
              </li>

          <?php } ?>

        </ul>
      </div>
    </div>
  </nav>

  <!-- Header -->
  <header class="masthead">
    <div class="container d-flex h-100 align-items-center">
      <div class="mx-auto text-center">
        <h1 class="mx-auto my-0 text-uppercase">pulmGym</h1>
        <h2 class="text-white-50 mx-auto mt-2 mb-5">A Gym which does not hold you back</h2>
        <a href="register.php" class="btn btn-primary js-scroll-trigger">Get Started</a>
      </div>
    </div>
  </header>

  <!-- About Section -->
  <section id="about" class="about-section text-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2 class="text-white mb-4">We guide with care</h2>
          <p class="text-white-50">pulmGym is a mobile gym with proper guidance from our passionate trainers. see our plans here,
            <a href="module.php">our training modules</a>.This is gym which you can move with.</p>
          <h5 style="color: snow;">And now it comes in mobile</h5>
        </div>
      </div>
      <img src="img/a.png" class="img-fluid" style="padding-left: 15%;" alt="">



    </div>
  </section>

  <!-- Projects Section -->
  <section id="projects" class="projects-section bg-light">
    <div class="container">

      <!-- Featured Project Row -->
      <div class="row align-items-center no-gutters mb-4 mb-lg-5">
        <div class="col-xl-8 col-lg-7">
          <img class="img-fluid mb-3 mb-lg-0" src="img/bg-masthead.jpg" alt="">
        </div>
        <div class="col-xl-4 col-lg-5">
          <div class="featured-text text-center text-lg-left">
            <h4>Heavy Weight</h4>
            <p class="text-black-50 mb-0">Our trainers will provide clinical guidance for building muscle with free hand and heavy weight exercise.</p>
          </div>
        </div>
      </div>

      <!-- Project One Row -->
      <div class="row justify-content-center no-gutters mb-5 mb-lg-0">
        <div class="col-lg-6">
          <img class="img-fluid" src="img/demo-image-01.jpg" alt="">
        </div>
        <div class="col-lg-6">
          <div class="bg-black text-center h-100 project">
            <div class="d-flex h-100">
              <div class="project-text w-100 my-auto text-center text-lg-left">
                <h4 class="text-white">Misty</h4>
                <p class="mb-0 text-white-50">Light weight as mist with maximum acrobatic ability, with us loose fat and set milestone of the highest performance. </p>
                <hr class="d-none d-lg-block mb-0 ml-0">
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Project Two Row -->
      <div class="row justify-content-center no-gutters">
        <div class="col-lg-6">
          <img class="img-fluid" src="img/demo-image-02.jpg" alt="">
        </div>
        <div class="col-lg-6 order-lg-first">
          <div class="bg-black text-center h-100 project">
            <div class="d-flex h-100">
              <div class="project-text w-100 my-auto text-center text-lg-right">
                <h4 class="text-white">Mountains</h4>
                <p class="mb-0 text-white-50">Stay as strong as mountain. Hold the ground with maximum strength so you never collapse.</p>
                <hr class="d-none d-lg-block mb-0 mr-0">
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- Signup Section -->
  <section id="signup" class="signup-section">
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-lg-8 mx-auto text-center">



        </div>
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section class="contact-section bg-black">
    <div class="container">

      <div class="row">

        <div class="col-md-4 mb-3 mb-md-0">
          <div class="card py-4 h-100">
            <div class="card-body text-center">
              <i class="fas fa-map-marked-alt text-primary mb-2"></i>
              <h4 class="text-uppercase m-0">Address</h4>
              <hr class="my-4">
              <div class="small text-black-50">Kumira Shitakundo, Ctg</div>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-3 mb-md-0">
          <div class="card py-4 h-100">
            <div class="card-body text-center">
              <i class="fas fa-envelope text-primary mb-2"></i>
              <h4 class="text-uppercase m-0">Email</h4>
              <hr class="my-4">
              <div class="small text-black-50">
                <a href="#">emonSumon&lemon@paknaFora.com</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-3 mb-md-0">
          <div class="card py-4 h-100">
            <div class="card-body text-center">
              <i class="fas fa-mobile-alt text-primary mb-2"></i>
              <h4 class="text-uppercase m-0">Phone</h4>
              <hr class="my-4">
              <div class="small text-black-50">+1 (555) 902-8832</div>
            </div>
          </div>
        </div>
      </div>

      <div class="social d-flex justify-content-center">
        <a href="#" class="mx-2">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="#" class="mx-2">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="#" class="mx-2">
          <i class="fab fa-github"></i>
        </a>
      </div>

    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-black small text-center text-white-50">
    <div class="container">
      Copyright &copy; pulmGym 2019
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/grayscale.min.js"></script>

</body>

</html>
