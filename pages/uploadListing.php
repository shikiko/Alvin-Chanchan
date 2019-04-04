<?php 
$currentPage = 'New Listing';
include("../headers/header.inc.php");
require_once("../private/config.php");
require_once("../php_scripts/ins_listing.php");
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
  <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome CSS-->
  <link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.min.css">
  <!-- Google fonts - Roboto-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,700">
  <!-- Bootstrap Select-->
  <link rel="stylesheet" href="../vendor/bootstrap-x`/css/bootstrap-select.min.css">
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
        <div class="row">
          <div class="col-lg-12">
            <div class="box"> 
                <h1 class="text-upper">Welcome, <?php echo $_SESSION["username"]; ?></h1>
              <?php  if($error != ''){echo '<div role="alert" class="alert alert-danger">'.$error.'</div>';} ?>
              <h2 class="text-uppercase">New Listing</h2>
              <p class="lead">Ready to Sell?</p>
              <p>Fill in a few important details and help describe your product so that Users know what they're getting!</p>
              <hr>
              <?php if($successfulUpload == true){echo '<div role="alert" class="alert alert-success">Your listing has been created.</div>';} ?>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post"enctype="multipart/form-data" >
                <input type='hidden' name='action' value='upload'/>
                <div class="form-group">
                  <label >Item Name</label>
                  <span class="error">* <?php echo $itemnameErr;?></span>
                  <input id="itemname" type="text" class="form-control"  name="itemname">
                </div>
                <div class="form-group">
                  <label >Item Condition</label>
                  <input id="itemcond" type="text" class="form-control" name="itemcond">
                </div>
                <div class="form-group">
                  <label >Price</label>
                  <span class="error">* <?php echo $itempriceErr;?></span>
                  <input id="itemprice" type="number" step="0.01" class="form-control" name="itemprice">
                </div>
                <div class="form-group">
                  <label >Duration</label>
                  <span class="error">* <?php echo $itemdurErr;?></span>
                  <input id="itemdur" type="number" class="form-control" name="itemdur">
                </div>
                <div class="form-group">
                  <label >Trading Location</label>
                  <span class="error">* <?php echo $tradelocErr;?></span>
                  <input id="tradeloc" type="text" class="form-control" name="tradeloc">
                </div>
                <div class="form-group">
                  <label >Category</label>
                  <select id="category" class="form-control" name="itemcat">
                      <option value='Computers and IT'>Computers and IT</option>
                      <option value='Furniture'>Furniture</option>
                      <option value='Home Appliances'>Home Appliances</option>
                      <option value='Home Repairs and Services'>Home Repairs and Services</option>
                      <option value='Kids'>Kids</option>
                  </select>
                </div>
                <div class="form-group">
                  <label >Description</label>
                  <textarea id="itemdesc" class="form-control" style="resize: none;"name="itemdesc"></textarea>
                </div>
                <div class="form-group">
                        <label>Item Picture</label>
                        <span class="error"><?php if(!empty($imageErr)){echo $imageErr;}?></span>
                        <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*">                    
                </div>
                  <input type="hidden" name="sellerid" value="<?php$sellerid?>">
                <span class="error">* <?php if(empty($createErr)){echo "required field";}else{echo $createErr;}?></span>   
                <div class="text-center">
                  <button type="submit" class="btn btn-template-outlined" name="upload" value='upload'><i class="fa fa-user-md"></i> Create</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <?php include("../headers/footer.inc.php"); ?>
    <!-- Javascript files-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/popper.../js/umd/popper.min.js"> </script>
    <script src="../vendor/bootstrap/../js/bootstrap.min.js"></script>
    <script src="../vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="../vendor/waypoints/lib/jquery.waypoints.min.js"> </script>
    <script src="../vendor/jquery.counterup/jquery.counterup.min.js"> </script>
    <script src="../vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="../vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js"></script>
    <script src="../js/jquery.parallax-1.1.3.js"></script>
    <script src="../vendor/bootstrap-select/../js/bootstrap-select.min.js"></script>
    <script src="../vendor/jquery.scrollto/jquery.scrollTo.min.js"></script>
    <script src="../js/front.js"></script>
  </body>
  </html>