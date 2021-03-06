<?php 
$currentPage = 'register';
require_once("../private/config.php");
require_once("../php_scripts/register_login.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
</head>
<body>
  <div id="all">
    <?php include("../headers/header.inc.php"); ?>
    <div id="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="box">
              <h2 class="text-uppercase">New account</h2>
              <p class="lead">Not our registered customer yet?</p>
              <p>With registration with us new world of fashion, fantastic discounts and much more opens to you! The whole process will not take you more than a minute!</p>
              <hr>
              <?php if($successfulRegister == true){echo '<div role="alert" class="alert alert-success">Your account has been made, Please verify it by clicking the activation link that has been send to your email.</div>';}?>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                <input type='hidden' name='action' value='register' />
                <div class="form-group">
                  <label for="name-login">Username</label>
                  <span class="error">* <?php echo $nameErr;?></span>
                  <input id="name-login" type="text" class="form-control"  name="name">
                </div>
                <div class="form-group">
                  <label for="email-login">Email</label>
                  <span class="error">* <?php echo $emailErr;?></span>
                  <input id="email-login" type="text" class="form-control" name="email">
                </div>
                <div class="form-group">
                  <label for="password-login">Password</label>
                  <span class="error">* <?php echo $passwordErr;?></span>
                  <input id="password-login" type="password" class="form-control" name="password">
                </div>
                <span class="error">* <?php if(empty($createErr)){echo "required field";}else{echo $createErr;}?></span>   
                <div class="text-center">
                  <button type="submit" class="btn btn-template-outlined" name="register" value='register'><i class="fa fa-user-md"></i> Register</button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="box">
              <h2 class="text-uppercase">Login</h2>
              <p class="lead">Already our customer?</p>
              <p class="text-muted">Please login here.</p>
              <?php  if($error == true){echo '<div role="alert" class="alert alert-danger">Wrong password</div>';} ?>
              <hr>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                <div class="form-group">
                  <label for="email-login">Username</label>
                  <span class="error"><?php if(!empty($loginusernameErr)){echo $loginusernameErr;}?></span>   
                  <input id="email-login" type="text" class="form-control" name="username">
                </div>
                <div class="form-group">
                  <label for="password-login">Password</label>
                  <span class="error"><?php if(!empty($loginPasswordErr)){echo $loginPasswordErr;}?></span>   
                  <input id="password-login" type="password" class="form-control" name="password">
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-template-outlined" name='login' value='login'><i class="fa fa-sign-in"></i> Log in</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include("../headers/footer.inc.php"); ?>
        <!-- Javascript files-->
        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/popper.js/umd/popper.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="../vendor/jquery.cookie/jquery.cookie.js"></script>
        <script src="../vendor/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="../vendor/jquery.counterup/jquery.counterup.min.js"></script>
        <script src="../vendor/owl.carousel/owl.carousel.min.js"></script>
        <script src="../vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js"></script>
        <script src="../js/jquery.parallax-1.1.3.js"></script>
        <script src="../vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
        <script src="../vendor/jquery.scrollto/jquery.scrollTo.min.js"></script>
        <script src="../js/front.js"></script>
  </body>
  </html>