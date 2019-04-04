<?php 
$currentPage = 'Edit Listing';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $targetitem = $_POST["targetitem"];
}else{
    header("Location: ../error/401.php");
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
  <!-- Tweaks for older IEs--><!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<body>
  <div id="all">
      <?php include("../headers/header.inc.php");
        require_once("../private/config.php");
        require_once("../php_scripts/listing_edit.php") ;
        $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
            if (mysqli_connect_errno()) {
                header("Location: ../error/500.php");
                die("Connection failed: " . $conn->connect_error);
            }
        ?>
    <div id="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="box">
                <?php
                $edsql="SELECT ItemName,Price,TradingLocation,Description from items where ItemID=".$targetitem;
                 if($edresult= mysqli_query($connection,$edsql)){
                while ($row = mysqli_fetch_assoc($edresult)) {
                $oldName=$row['ItemName'];
                $oldPrice=$row['Price'];
                $oldLoc=$row['TradingLocation'];
                $oldDesc=$row['Description'];
                }
                }
                ?>
                <h1 class="text-upper">Welcome, <?php echo $_SESSION["username"]; ?></h1>
              <h2 class="text-uppercase">Edit Listing</h2>
              <p class="lead">Change it up.</p>
              <p>Fill in a few important details and help describe your product so that Users know what they're getting!</p>
              <hr>
              <?php if($successfulUpload == true){echo '<div role="alert" class="alert alert-success">Your listing has been updated.</div>';} ?>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post"enctype="multipart/form-data" >
                <input type='hidden' name='action' value='upload'/>
                <input type='hidden' name='targetitem' value='<?php echo $targetitem?>'/>
                <div class="form-group">
                  <label >Item Name</label>
                  <span class="error">* <?php echo $itemnameErr;?></span>
                  <input id="itemname" type="text" class="form-control"  name="itemname" value="<?php echo $oldName?>">
                </div>
                <div class="form-group">
                  <label >Price</label>
                  <span class="error">* <?php echo $itempriceErr;?></span>
                  <input id="itemprice" type="number" step="0.01" class="form-control" name="itemprice" value="<?php echo $oldPrice?>">
                </div>
                <div class="form-group">
                  <label >Trading Location</label>
                  <span class="error">* <?php echo $tradelocErr;?></span>
                  <input id="tradeloc" type="text" class="form-control" name="tradeloc" value="<?php echo $oldLoc?>">
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
                  <textarea id="itemdesc" class="form-control" style="resize: none;"name="itemdesc" ><?php echo $oldDesc?></textarea>
                </div>
                <div class="form-group">
                        <label>Item Picture</label>
                        <span class="error"><?php if(!empty($imageErr)){echo $imageErr;}?></span>
                        <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*">                    
                </div>
                <div class="form-group">
                        <label>Mark as sold?</label>
                        <span class="error"><?php if(!empty($imageErr)){echo $imageErr;}?></span>
                        <input type="checkbox" name="markSold" id="markSold">                    
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
  </body>
  </html>