<?php 
  $currentPage = 'Profile'; 
  require_once("../private/config.php");
  require_once("../php_scripts/profile_view.php");
  include("../headers/header.inc.php");
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Universal - All In 1 Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.min.css">
    <!-- Google fonts - Roboto-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,700">
    <!-- Bootstrap Select-->
    <link rel="stylesheet" href="../vendor/bootstrap-select/css/bootstrap-select.min.css">
    <!-- owl carousel-->
    <link rel="stylesheet" href="../vendor/owl.carousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="../vendor/owl.carousel/assets/owl.theme.default.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="../css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="../css/custom.css">
    <!-- Favicon and apple touch icons-->
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="../img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="57x57" href="../img/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../img/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../img/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../img/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../img/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../img/apple-touch-icon-152x152.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div id="content" class="team-member-detail">
        <div class="container">
          <section class="bar">
            <div class="row">
              <div class="col-md-12">
                <div class="heading">
                <?php
                  echo '<h2>About ';
                  echo $_GET['username'];
                  echo "</h2>";
                  ?>
                </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-4"><img alt="" src="../img/profilepictures/082612086538.jpg" class="img-fluid rounded-circle"></div>
              <div class="col-md-8">
                <div class="heading">
                  <h3>Han's Details</h3>
                </div>
                <ul class="ul-icons list-unstyled">
                  <li>
                    <div class="icon-filled"><i class="fa fa-phone fix"></i></div><span class="fixword">Phone here</span>
                  </li>
                  <li>
                    <div class="icon-filled"><i class="fa fa-envelope fix"></i></div>Email here
                  </li>
                  <li>
                    <div class="icon-filled"><i class="fa fa-user fix"></i></div>Gender
                  </li>
                </ul>
              </div>
            </div>
          </section>
        </div>
        <section class="bar bg-gray">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="heading text-center">
                  <h2>Clients Han is taking care of</h2>
                </div>
                <ul class="list-unstyled owl-carousel customers no-mb">
                  <li class="item"><img src="img/customer-1.png" alt="" class="img-fluid"></li>
                  <li class="item"><img src="img/customer-2.png" alt="" class="img-fluid"></li>
                  <li class="item"><img src="img/customer-3.png" alt="" class="img-fluid"></li>
                  <li class="item"><img src="img/customer-4.png" alt="" class="img-fluid"></li>
                  <li class="item"><img src="img/customer-5.png" alt="" class="img-fluid"></li>
                  <li class="item"><img src="img/customer-6.png" alt="" class="img-fluid"></li>
                </ul>
              </div>
            </div>
          </div>
        </section>
      </div>
    <?php include("../headers/footer.inc.php"); ?>
    <!-- Javascript files-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/popper.js/umd/popper.min.js"> </script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="../vendor/waypoints/lib/jquery.waypoints.min.js"> </script>
    <script src="../vendor/jquery.counterup/jquery.counterup.min.js"> </script>
    <script src="../vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="../vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js"></script>
    <script src="../js/jquery.parallax-1.1.3.js"></script>
    <script src="../vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
    <script src="../vendor/jquery.scrollto/jquery.scrollTo.min.js"></script>
    <script src="../js/front.js"></script>
  </body>
</html>