<?php 
   $currentPage = 'register';
   require_once("config.php");
   
   // If user posts a request.
   // TODO : Validate input!!!
   // TODO: 
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
   echo '<script>console.log("[DEBUG]POSTING")</script>';
   $name = trim_input($_POST["name"]);
   echo '<script>console.log("[DEBUG]Name:';
   echo $name;
   echo '")</script>';
   
   $email = trim_input($_POST["email"]);
   echo '<script>console.log("[DEBUG]Email:';
   echo $email;
   echo '")</script>';
   
   $password = trim_input($_POST["password"]);
   echo '<script>console.log("[DEBUG]Password:';
   echo $password;
   echo '")</script>';
   
   
   // Create connection
   $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
   // Check connection
   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
   }
   
   $sql = "INSERT INTO User (username, email, password)
   VALUES ('$email', '$name', '$password')";
   
   if ($conn->query($sql) === TRUE) {
      echo '<script>console.log("[DEBUG]New record created successfully")</script>';
   } else {
      $error = "Error: " . $sql . "<br>" . $conn->error;
      echo '<script>console.log("[DEBUG]Password:';
      echo $error;
      echo '")</script>';  
    }
   }
   
   function trim_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
   }
   
   // Close connection
   $conn->close();
   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="robots" content="all,follow">
      <!-- Bootstrap CSS-->
      <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
      <!-- Font Awesome CSS-->
      <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
      <!-- Google fonts - Roboto-->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,700">
      <!-- Bootstrap Select-->
      <link rel="stylesheet" href="vendor/bootstrap-select/css/bootstrap-select.min.css">
      <!-- owl carousel-->
      <link rel="stylesheet" href="vendor/owl.carousel/assets/owl.carousel.css">
      <link rel="stylesheet" href="vendor/owl.carousel/assets/owl.theme.default.css">
      <!-- theme stylesheet-->
      <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
      <!-- Custom stylesheet - for your changes-->
      <link rel="stylesheet" href="css/custom.css">
      <!-- Favicon and apple touch icons-->
      <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
      <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
      <link rel="apple-touch-icon" sizes="57x57" href="img/apple-touch-icon-57x57.png">
      <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
      <link rel="apple-touch-icon" sizes="76x76" href="img/apple-touch-icon-76x76.png">
      <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png">
      <link rel="apple-touch-icon" sizes="120x120" href="img/apple-touch-icon-120x120.png">
      <link rel="apple-touch-icon" sizes="144x144" href="img/apple-touch-icon-144x144.png">
      <link rel="apple-touch-icon" sizes="152x152" href="img/apple-touch-icon-152x152.png">
      <!-- Tweaks for older IEs--><!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
   </head>
   <body>
      <div id="all">
      <?php include("header.inc.php"); ?>
      <div id="content">
         <div class="container">
            <div class="row">
               <div class="col-lg-6">
                  <div class="box">
                     <h2 class="text-uppercase">New account</h2>
                     <p class="lead">Not our registered customer yet?</p>
                     <p>With registration with us new world of fashion, fantastic discounts and much more opens to you! The whole process will not take you more than a minute!</p>
                     <hr>
                     <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                        <div class="form-group">
                           <label for="name-login">Username</label>
                           <input id="name-login" type="text" class="form-control"  name="name">
                        </div>
                        <div class="form-group">
                           <label for="email-login">Email</label>
                           <input id="email-login" type="text" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                           <label for="password-login">Password</label>
                           <input id="password-login" type="password" class="form-control" name="password">
                        </div>
                        <div class="text-center">
                           <button type="submit" class="btn btn-template-outlined"><i class="fa fa-user-md"></i> Register</button>
                        </div>
                     </form>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="box">
                     <h2 class="text-uppercase">Login</h2>
                     <p class="lead">Already our customer?</p>
                     <p class="text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                     <hr>
                     <form action="customer-orders.html" method="get">
                        <div class="form-group">
                           <label for="email">Email</label>
                           <input id="email" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                           <label for="password">Password</label>
                           <input id="password" type="password" class="form-control">
                        </div>
                        <div class="text-center">
                           <button type="submit" class="btn btn-template-outlined"><i class="fa fa-sign-in"></i> Log in</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php include("footer.inc.php"); ?>
      <!-- Javascript files-->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/popper.js/umd/popper.min.js"> </script>
      <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
      <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
      <script src="vendor/waypoints/lib/jquery.waypoints.min.js"> </script>
      <script src="vendor/jquery.counterup/jquery.counterup.min.js"> </script>
      <script src="vendor/owl.carousel/owl.carousel.min.js"></script>
      <script src="vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js"></script>
      <script src="js/jquery.parallax-1.1.3.js"></script>
      <script src="vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
      <script src="vendor/jquery.scrollto/jquery.scrollTo.min.js"></script>
      <script src="js/front.js"></script>
   </body>
</html>

