<?php 
  $currentPage = 'Submit Review';
  require_once("../private/config.php");
  //if method is post then
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $retrievedtarget = $_POST["targetuser"];
  }
  else{
      header("Location: ../error/401.php");
  }
?>
<html>
    <?php
    include("../headers/header.inc.php");
    require_once("../php_scripts/ins_review.php");?>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
    <div id="all">
      <div id="content">
        <div class="container">
          <div class="row bar">
            <div id="customer-account" class="col-lg-9 clearfix">
              <h1 class="text-upper">Welcome, <?php echo $_SESSION["username"]; ?></h1>
             <div class="box mt-5">
                <div class="heading">
                  <h3 class="text-uppercase">Write review</h3>
                </div>
                <?php if($successfulRev == true){echo '<div role="alert" class="alert alert-success">Your Review has been posted.Redirecting you in a few seconds.</div>';} ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" >
                <input type='hidden' name='review' value='review'/>
                <input type="hidden" name="retrievedtarget" value="<?php echo $retrievedtarget ?>"/>
                <div class="form-group">
                  <label >Comment</label> 
                  <span class="error">* <?php echo $revCommErr;?></span>
                  <textarea id="revComm" class="form-control" style='resize: none;' name="revComm"></textarea>
                </div>
                <div class="form-group">
                  <fieldset class="rating">
                    <input type="radio" checked="checked" id="star5" name="rating" value=5 /><label class = "full" for="star5" title="5 stars"></label>
                    <input type="radio" id="star4" name="rating" value=4 /><label class = "full" for="star4" title="=4 stars"></label>
                    <input type="radio" id="star3" name="rating" value=3 /><label class = "full" for="star3" title="3 stars"></label>
                    <input type="radio" id="star2" name="rating" value=2 /><label class = "full" for="star2" title="2 stars"></label>
                    <input type="radio" id="star1" name="rating" value=1 /><label class = "full" for="star1" title="1 star"></label>
                </fieldset>
                </div>
                <br/><br/>
                <span class="error">* <?php if(empty($createErr)){echo "required field";}else{echo $createErr;}?></span>   
                <div class="text-center">
                  <button type="submit" class="btn btn-template-outlined" name="review" value='review'><i class="fa fa-user-md"></i> Submit review</button>
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php
    include("../headers/footer.inc.php");
     ?>
    </div>
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