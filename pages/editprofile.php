<?php 
  $currentPage = 'Edit Profile';
  include("../headers/header.inc.php");
  require_once("../private/config.php");
  require("../php_scripts/profile_edit.php");
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
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
                  <h3 class="text-uppercase">Change password</h3>
                </div>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                <?php if($successfully == true){echo '<div role="alert" class="alert alert-success">Sucessfully changed password.</div>';} ?>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="password_old">Old password</label>
                        <input id="password_old" type="password" class="form-control" name="password_old">
                        <span class="error"><?php if(!empty($password_oldErr)){echo $password_oldErr;}?></span> 
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="password_1">New password</label>
                        <input id="password_1" type="password" class="form-control" name="password_1">
                        <span class="error"><?php if(!empty($passwordNewErr)){echo $passwordNewErr;}?></span> 
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="password_2">Confirm Password</label>
                        <input id="password_2" type="password" class="form-control" name="password_2">
                      </div>
                    </div>
                  </div>
                  <div class="text-center">
                  <button type="submit" class="btn btn-template-outlined" name='save_new_password' value='password'><i class="fa fa-save"></i> Save new Password</button>
                  </div>
                </form>
              </div>
              <div class="bo3">
                <div class="heading">
                  <h3 class="text-uppercase">Personal details</h3>
                </div>
                <?php if($successfulUpdate == true){echo '<div role="alert" class="alert alert-success">Successfully Updated..</div>';} ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="phone">Telephone</label> 
                        <input id="phone" type="text" class="form-control" name="phone">
                        <span class="error"><?php if(!empty($phoneErr)){echo $phoneErr;}?></span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="gender">Gender</label>
                        <select id="gender" class="form-control" name="gender">
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="prof_pic">Profile Picture</label>
                        <br>
                        <input type="file" name="fileToUpload" id="fileToUpload">                    
                      </div>
                      <span class="error"><?php if(!empty($imageErr)){echo $imageErr;}?></span>
                    </div>
                    <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-template-outlined" name='personal' value='personal'><i class="fa fa-save"></i> Save Changes</button>
                    </div>
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
  </body>


</html>