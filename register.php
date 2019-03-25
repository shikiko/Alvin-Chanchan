<?php 
$currentPage = 'register';
require_once("config.php");
echo '<script>console.log("[DEBUG]Password:';
echo session_id();
echo '")</script>';  
echo '<script>console.log("[DEBUG]TEST?")</script>';

$nameErr = $emailErr = $passwordErr = $createErr = $loginEmailErr = $loginPasswordErr = "";
// If user posts a request.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

//if login button is clicked
if (!empty($_POST['login'])){
  $check = true;
  if (empty($_POST["username"])) {
    $loginusernameErr = "* Please enter username";
    $check = False;
  } else {
    $username = trim_input($_POST["username"]);
  }

  if (empty($_POST["password"])) {
    $loginPasswordErr = "* Please enter password";
    $check = False;
  } else {
    $password = trim_input($_POST["password"]);
  }


  if($check == True){
    // Create connection
    $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    // Check connection
    if ($conn->connect_error) {
      echo "connection error";
      die("Connection failed: " . $conn->connect_error);
    }else{
      $sql = "select * from User where username = '$username' AND password ='$password'";
      // if query checks out
      if ($conn->query($sql) !== FALSE) {
        echo '<script>console.log("[DEBUG]Found you")</script>';
        echo '<script>alert("';
        echo session_id();
        echo '");</script>';
        session_start();
        $_SESSION["username"] = $username;
        header("Location: http://localhost/alvin-chanchan/profilepage.php");
      } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        echo '<script>console.log("[DEBUG]SQL Staement:';
        echo $error;
        echo '")</script>';  
      }
    // Close connection
      $conn->close();
    }//end of insert
  }
} 

// if register button is clciked
if (!empty($_POST["register"])){ 
  $check = True;
  if (empty($_POST["name"])) {
    $nameErr = "Username is required";
    $check = False;
  } else {
    $name = trim_input($_POST["name"]);
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
    $check = False;
  } else {
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
      $check = False;
    }else{
      $email = trim_input($_POST["email"]);
    }
  }

  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
    $check = False;
  } else {
    $password = trim_input($_POST["password"]);
  }


  if($check == True){
    if(CheckValid($name, $email)){
    // Create connection
      $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    // Check connection
      if ($conn->connect_error) {
        echo "connection error";
        die("Connection failed: " . $conn->connect_error);
      }else{
        $sql = "INSERT INTO User (username, email, password)
        VALUES ('$name', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
          echo '<script>console.log("[DEBUG]New record created successfully")</script>';
        } else {
          $error = "Error: " . $sql . "<br>" . $conn->error;
          echo '<script>console.log("[DEBUG]Password:';
          echo $error;
          echo '")</script>';  
        }
    // Close connection
        $conn->close();
    }//end of insert
  }else{
    $createErr = "Email/Username already exists";
    }//end of check valid
    }//end of ($check==true)
    }// end of post request
  } 

  function trim_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

//checks if username / email had been used already
  function CheckValid($username, $email){
    $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    //checks connection
    if ($conn->connect_error){
     die("Connection failed: " . $conn->connect_error);
   }else{
    $sql = "select * from User where username = '$username' OR email ='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
      echo '<script>console.log("[DEBUG]Existing username/email.")</script>';
      return false;
    }else{
      return true;
    }
  }
  $conn->close();
}


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
              <p class="text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
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