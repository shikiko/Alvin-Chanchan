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
                  <a href="../pages/uploadListing" class="signup-btn"><i class="fa fa-balance-scale"></i>
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
<div id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modalLabel" aria-hidden="true" class="modal fade">
   <div role="document" class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h4 id="login-modalLabel" class="modal-title">Customer Login</h4>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
         </div>
         <div class="modal-body">
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">               <div class="form-group">
                  <input id="email-login" type="text" class="form-control" name="username" placeholder="Username">
                  <span class="error"><?php if(!empty($loginusernameErr)){echo $loginusernameErr;}?></span> 
               </div>
               <div class="form-group">
                  <span class="error"><?php if(!empty($loginPasswordErr)){echo $loginPasswordErr;}?></span>   
                  <input id="password-login" type="password" class="form-control" name="password" placeholder="Password">
               </div>
               <p class="text-center">
                  <button type="submit" class="btn btn-template-outlined" name='login_modal' value='login_modal'><i class="fa fa-sign-in"></i> Log in</button>
               </p>
            </form>
            <p class="text-center text-muted">Not registered yet?</p>
            <p class="text-center text-muted"><a href="register.php"><strong>Register now</strong></a>! It is easy and done in 1 minute and gives you access to special discounts and much more!</p>
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
               <!-- ========== FULL WIDTH MEGAMENU ==================-->
               <li class="nav-item dropdown menu-large">
                  <a href="#" data-toggle="dropdown" data-hover="dropdown" data-delay="200" class="dropdown-toggle">All Pages <b class="caret"></b></a>
                  <ul class="dropdown-menu megamenu">
                     <li>
                        <div class="row">
                           <div class="col-md-6 col-lg-3">
                              <h5>Home</h5>
                              <ul class="list-unstyled mb-3">
                                 <li class="nav-item"><a href="index.html" class="nav-link">Option 1: Default Page</a></li>
                                 <li class="nav-item"><a href="index2.html" class="nav-link">Option 2: Application</a></li>
                                 <li class="nav-item"><a href="index3.html" class="nav-link">Option 3: Startup</a></li>
                                 <li class="nav-item"><a href="index4.html" class="nav-link">Option 4: Agency</a></li>
                                 <li class="nav-item"><a href="index5.html" class="nav-link">Option 5: Portfolio</a></li>
                              </ul>
                              <h5>About</h5>
                              <ul class="list-unstyled mb-3">
                                 <li class="nav-item"><a href="about.html" class="nav-link">About us</a></li>
                                 <li class="nav-item"><a href="team.html" class="nav-link">Our team</a></li>
                                 <li class="nav-item"><a href="team-member.html" class="nav-link">Team member</a></li>
                                 <li class="nav-item"><a href="services.html" class="nav-link">Services</a></li>
                              </ul>
                              <h5>Marketing</h5>
                              <ul class="list-unstyled mb-3">
                                 <li class="nav-item"><a href="packages.html" class="nav-link">Packages</a></li>
                              </ul>
                           </div>
                           <div class="col-md-6 col-lg-3">
                              <h5>Portfolio</h5>
                              <ul class="list-unstyled mb-3">
                                 <li class="nav-item"><a href="portfolio-2.html" class="nav-link">2 columns</a></li>
                                 <li class="nav-item"><a href="portfolio-no-space-2.html" class="nav-link">2 columns with negative space</a></li>
                                 <li class="nav-item"><a href="portfolio-3.html" class="nav-link">3 columns</a></li>
                                 <li class="nav-item"><a href="portfolio-no-space-3.html" class="nav-link">3 columns with negative space</a></li>
                                 <li class="nav-item"><a href="portfolio-4.html" class="nav-link">4 columns</a></li>
                                 <li class="nav-item"><a href="portfolio-no-space-4.html" class="nav-link">4 columns with negative space</a></li>
                                 <li class="nav-item"><a href="portfolio-detail.html" class="nav-link">Portfolio - detail</a></li>
                                 <li class="nav-item"><a href="portfolio-detail-2.html" class="nav-link">Portfolio - detail 2</a></li>
                              </ul>
                              <h5>User pages</h5>
                              <ul class="list-unstyled mb-3">
                                 <li class="nav-item"><a href="customer-register.html" class="nav-link">Register / login</a></li>
                                 <li class="nav-item"><a href="customer-orders.html" class="nav-link">Orders history</a></li>
                                 <li class="nav-item"><a href="customer-order.html" class="nav-link">Order history detail</a></li>
                                 <li class="nav-item"><a href="customer-wishlist.html" class="nav-link">Wishlist</a></li>
                                 <li class="nav-item"><a href="customer-account.html" class="nav-link">Customer account / change password</a></li>
                              </ul>
                           </div>
                           <div class="col-md-6 col-lg-3">
                              <h5>Shop</h5>
                              <ul class="list-unstyled mb-3">
                                 <li class="nav-item"><a href="shop-category.html" class="nav-link">Category - sidebar right</a></li>
                                 <li class="nav-item"><a href="shop-category-left.html" class="nav-link">Category - sidebar left</a></li>
                                 <li class="nav-item"><a href="shop-category-full.html" class="nav-link">Category - full width</a></li>
                                 <li class="nav-item"><a href="shop-detail.html" class="nav-link">Product detail</a></li>
                              </ul>
                              <h5>Shop - order process</h5>
                              <ul class="list-unstyled mb-3">
                                 <li class="nav-item"><a href="shop-basket.html" class="nav-link">Shopping cart</a></li>
                                 <li class="nav-item"><a href="shop-checkout1.html" class="nav-link">Checkout - step 1</a></li>
                                 <li class="nav-item"><a href="shop-checkout2.html" class="nav-link">Checkout - step 2</a></li>
                                 <li class="nav-item"><a href="shop-checkout3.html" class="nav-link">Checkout - step 3</a></li>
                                 <li class="nav-item"><a href="shop-checkout4.html" class="nav-link">Checkout - step 4</a></li>
                              </ul>
                           </div>
                           <div class="col-md-6 col-lg-3">
                              <h5>Contact</h5>
                              <ul class="list-unstyled mb-3">
                                 <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
                                 <li class="nav-item"><a href="contact2.html" class="nav-link">Contact - version 2</a></li>
                                 <li class="nav-item"><a href="contact3.html" class="nav-link">Contact - version 3</a></li>
                              </ul>
                              <h5>Pages</h5>
                              <ul class="list-unstyled mb-3">
                                 <li class="nav-item"><a href="text.html" class="nav-link">Text page</a></li>
                                 <li class="nav-item"><a href="text-left.html" class="nav-link">Text page - left sidebar</a></li>
                                 <li class="nav-item"><a href="text-full.html" class="nav-link">Text page - full width</a></li>
                                 <li class="nav-item"><a href="faq.html" class="nav-link">FAQ</a></li>
                                 <li class="nav-item"><a href="404.html" class="nav-link">404 page</a></li>
                              </ul>
                              <h5>Blog</h5>
                              <ul class="list-unstyled mb-3">
                                 <li class="nav-item"><a href="blog.html" class="nav-link">Blog listing big</a></li>
                                 <li class="nav-item"><a href="blog-medium.html" class="nav-link">Blog listing medium</a></li>
                                 <li class="nav-item"><a href="blog-small.html" class="nav-link">Blog listing small</a></li>
                                 <li class="nav-item"><a href="blog-post.html" class="nav-link">Blog Post</a></li>
                              </ul>
                           </div>
                        </div>
                     </li>
                  </ul>
               </li>
               <!-- ========== FULL WIDTH MEGAMENU END ==================-->
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

