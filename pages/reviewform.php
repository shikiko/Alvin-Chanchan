<?php 
  $currentPage = 'Submit Review';
  require_once("../private/config.php");
  //if method is post then
  
  if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["targetuser"])) {
  $retrievedtarget = $_POST["targetuser"];
  }else{
      $retrievedtarget='';
  }
  
?>
<html>
    <?php
    include("../headers/header.inc.php");
    if(empty($_SESSION["username"])){
    $URL="../error/401.php";
            echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
            echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}
    require_once("../php_scripts/ins_review.php");?>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
  </head>
  <body>
    <div id="all">
      <div id="content">
        <div class="container">
          <div class="row bar">
            <div id="customer-account" class="col-lg-9 clearfix">
              <h1 class="text-upper">Welcome, <?php echo $_SESSION["username"]; ?></h1>
                <?php  if($error != ''){echo '<div role="alert" class="alert alert-danger">'.$error.'</div>';} ?>
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
  </body>


</html>