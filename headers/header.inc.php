<?php 
if(!isset($_SESSION["username"])){
    session_start(); 
}

//echo $_SESSION["current_user"];

require_once("../private/config.php"); 
require_once("../php_scripts/login_modal.php");
require_once("../php_scripts/functions.php");


?>
<!-- Top bar-->
<title>Fast Trade | <?php echo $currentPage;?></title>
<div class="top-bar">
   <div class="container">
      <div class="row d-flex align-items-center">
         <div class="col-md-6 d-md-block d-none">
         </div>
         <div class="col-md-6">
            <div class="d-flex justify-content-md-end justify-content-between">
               <ul class="list-inline contact-info d-block d-md-none">
                  <li class="list-inline-item"><a href="#"><i class="fa fa-phone"></i></a></li>
                  <li class="list-inline-item"><a href="#"><i class="fa fa-envelope"></i></a></li>
               </ul>
               <?php
               echo '<script>console.log("[DEBUG]Session_Status():';
               echo session_status();
               echo '")</script>'; 
               if(!isset($_SESSION["username"])) {
                  //Session has not started (User Has not logged in)
                  echo '<div class="login"><a href="#" data-toggle="modal" data-target="#login-modal" class="login-btn">
                        <i class="fa fa-sign-in"></i><span class="d-none d-md-inline-block">Sign In</span></a>
                        <a href="../pages/register.php" class="signup-btn"><i class="fa fa-user"></i>
                        <span class="d-none d-md-inline-block">Sign Up</span></a></div>';
               }else{
                  //Session has started (User Logged in)
                  echo '<div class="login"><a class="login-btn" href="../pages/profile.php?username='.($_SESSION["username"]);
                  echo'">
                  <i class="fa fa-user"></i><span class="d-none d-md-inline-block">My Profile</span></a>
                  <a href="../pages/uploadListing.php" class="signup-btn"><i class="fa fa-balance-scale"></i>
                  <span class="d-none d-md-inline-block">Create Listing</span></a>
                  <a href="Inbox.php" class="signup-btn"><i class="fa fa-inbox"></i>
                  <span class="d-none d-md-inline-block">Messages</span></a>
                  <a href="../pages/logout.php" class="signup-btn"><i class="fa fa-power-off"></i>
                  <span class="d-none d-md-inline-block">Logout</span></a>
                  </div>';
               }?>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Top bar end-->
<!-- Login Modal-->
<div id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modalLabel" aria-hidden="true" class="modal fade" data-backdrop="static" >
   <div role="document" class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h4 id="login-modalLabel" class="modal-title">Customer Login</h4>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
         </div>
         <div class="modal-body">
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">               
               <div class="form-group">
                  <input id="email-login" type="text" class="form-control" name="username" placeholder="Username">
                  <span class="error"><?php if(!empty($loginusernameErr)){echo $loginusernameErr;}?></span> 
               </div>
               <div class="form-group">
                  <span class="error"><?php if(!empty($loginPasswordErr)){echo $loginPasswordErr;}?></span>   
                  <input id="password-login" type="password" class="form-control" name="password" placeholder="Password">
               </div>
               <p class="text-center">
                  <button type="submit" id="loginmodalbtn" class="btn btn-template-outlined" name='login_modal' value='login_modal' ><i class="fa fa-sign-in"></i> Log in</button>
               </p>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- Login modal end-->
<!-- Navbar Start-->
<header class="nav-holder make-sticky">
   <div id="navbar" role="navigation" class="navbar navbar-expand-lg">
      <div class="container">
         <a href="../pages/index.php" class="navbar-brand home"><img src="../img/Logo.png" alt="Fastrade logo" class="d-none d-md-inline-block"><img src="../img/logo-small.png" alt="Fasttrade logo" class="d-inline-block d-md-none"><span class="sr-only">FastTrade</span></a>
         <button type="button" data-toggle="collapse" data-target="#navigation" class="navbar-toggler btn-template-outlined"><span class="sr-only">Toggle navigation</span><i class="fa fa-align-justify"></i></button>
         <div id="navigation" class="navbar-collapse collapse">
            <ul class="nav navbar-nav ml-auto">
               <li class="nav-item dropdown <?php if($currentPage=='Home'){echo 'active';}?>"><a href="../pages/index.php?category=All">Home</b></a>
               </li>
               <li class="nav-item dropdown <?php if($currentPage=='Search'){echo 'active';}?>"><a href="../pages/search.php">Search</b></a>
               </li>
               <li class="nav-item dropdown <?php if($currentPage=='Contact Us'){echo 'active';}?>"><a href="../pages/contactus.php">Contact Us</b></a>
               </li>
               <?php if(isset($_SESSION["username"])){
                  $username = $_SESSION["username"];
                  if(CheckAdmin($username)){
                     echo '<li class="nav-item dropdown"><a href="javascript: void(0)" data-toggle="dropdown" class="dropdown-toggle">Admin <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li class="dropdown-item"><a href="../pages/manageprofiles.php" class="nav-link">Edit Profiles</a></li>
                  </ul>
                </li>';
                  }
               };
               ?>
            </ul>
         </div>
      </div>
   </div>
</header>
<!-- Navbar End-->
<!-- Breadcrumb Start-->
<div id="heading-breadcrumbs">
   <div class="container">
      <div class="row d-flex align-items-center flex-wrap">
         <div class="col-md-7">
            <h1 class="h2"><?php echo $currentPage; ?></h1>
         </div>
         <div class="col-md-5">
            <ul class="breadcrumb d-flex justify-content-end">
               <li class="breadcrumb-item"><a href="index.php">Home</a></li>
               <?php if($currentPage != 'Home'){
                  echo '<li class="breadcrumb-item active">';
                  echo $currentPage;
                  echo '</li>';
                  }?>
            </ul>
         </div>
      </div>
   </div>
</div>
<!-- Breadcrumb End -->

