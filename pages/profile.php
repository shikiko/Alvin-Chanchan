<?php 
  $currentPage = 'Profile'; 
  require_once("../php_scripts/profile_view.php");
  require_once("../private/config.php");
  if ($_SERVER['QUERY_STRING'] == ''){
    header('Location: index.php?category=All');
}
    $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
      if (!$conn) {
        header("Location: ../error/500.php");
        die("Connection failed: " . $conn->connect_error);
      }
      include("../headers/header.inc.php");
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
  </head>
  <body>
    <div id="content" class="team-member-detail">
        <div class="container">
          <section class="bar">
            <div class="row">
              <div class="col-md-12">
                <div class="heading">
                <?php
                  echo '<h2>About ';
                  echo $_GET['username'];
                  echo "</h2>";
                  ?>
                </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-2"><img alt="profilepic"
              <?php
              if($profilepic == ""){
                $profilepic = '../img/NoImg.png';
              }
              echo 'src="';
              echo "$profilepic";
              echo '"';
             ?>
            class="img-fluid rounded-circle"></div>
              <div class="col-md-7">
                <div class="heading">
                  <?php
                  echo '<h3>';
                  echo $_GET['username'];
                  echo "'s details</h3>";
                  ?>
                </div>  
                <ul class="ul-icons list-unstyled">
                  <li>
                    <div>Email: <?php echo $email ?></div>
                  </li>
                  <li>
                  <div>Telephone: <?php if(!isset($phone)){echo "Unspecified";}else{echo $phone;}?></div>
                  </li>
                  <li>
                    <div>Gender: <?php if(!isset($gender)){echo "Unspecified";}else{echo $gender;} ?></div>
                  </li>
                </ul>
              </div>
              <?php if($username == !empty($_SESSION["username"])){
                echo '<div class="col-lg-3 mt-4 mt-lg-0 col-md-2">
              <div class="panel panel-default sidebar-menu">
                <div class="panel-heading">
                  <h3 class="h4 panel-title">Options</h3>
                </div>
                <div class="panel-body">
                  <ul class="nav nav-pills flex-column text-sm">
                    <li class="nav-item"><a href="editprofile.php" class="nav-link active"><i class="fa fa-list"></i> Edit Profile</a></li>
                  </ul>
                </div>
              </div>
            </div>';
              }?>
 
            </div>
          </section>
        </div>
        <!--Get SellerID-->
        <section class="bar bg-gray">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="heading text-center"><?php
                echo "<h2>".$_GET['username']."'s Listings";
                ?>
                </div>
                <?php
                $othsql="SELECT ItemID,itemPicture,ItemName,Price FROM items where Sold = 0 AND Active= 1 AND Seller ='".$_GET['username']."'";
                if($othresult= mysqli_query($conn,$othsql)){
                    if(mysqli_num_rows($othresult)== 0){
                        echo '<h2 class=text-center style="margin:auto;">User has no other listings!</h2>';
                    }else{
                        echo '<ul class="owl-carousel testimonials list-unstyled equal-height">';
                        while ($row = mysqli_fetch_assoc($othresult)) {
                        echo '<li class="item">';
                        echo '<div class=product>';
                        echo '<div class=image><a href="listing.php?id='.$row['ItemID'].'">';
                        if ($row['itemPicture'] == NULL) {
                            echo '<img src="../img/NoImg.png" alt="No Image Available" class="img-fluid image1">';
                    }
                        else {
                            echo '<img src="'.$row['itemPicture'].'" alt="';
                            echo $row['ItemName'];
                            echo '" >';
                    }
                              echo '</a></div>';
                        echo '<div class=text>';
                        echo '<h3 class=h5><a href="listing.php?id='.$row['ItemID'].'">'.$row['ItemName'].'</a></h3>';
                        echo '<p class=price>$'.$row['Price'].'</p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</li>';  
                    }
                        echo '</ul>';
                    }  
                }
                ?>
              </div>
            </div>
          </div>
        </section>
        <section class="bar">
            <div class="container">
            <div class="row">
            <div class="col-md-12">
                <h1 class=text-center>Comments and Reviews</h1>
                <form class=text-center action="reviewform.php" method="POST">
                    <input type="hidden" name="targetuser" value="<?php echo $_GET['username']?>"/>
                    <input type="hidden" name="rating" value=""/>
                    <input type="hidden" name="retrievedtarget" value=""/>
                    <?php 
                    if(!empty($_SESSION["username"]) != NULL){if($_GET["username"] != $_SESSION["username"]){
                      echo '<button type="submit" class="btn btn-template-outlined" name="review" value="review"><i class="fa fa-user-md"></i> Submit review</button>';
                    }}?>

                </form>   
            </div>
            </div>
            <div class="row">
            
                <?php
                $revsql='SELECT * FROM review where targetuser="'.$_GET['username'].'" ORDER BY revDate DESC';
                if($revresult= mysqli_query($conn,$revsql)){
                    if(mysqli_num_rows($revresult)== 0){
                        echo '<h2 class=text-center style="margin:auto;">User has no other comments or reviews!!</h2>';
                    }else{
                        while ($row = mysqli_fetch_assoc($revresult)) {
                        echo '<div class=col-md-6 id=comment>';
                        echo '<div class=card>';
                        echo '<div class=card-body>';
                        echo '<div class=card-title>Name : '.$row['reviewer'].'</div>';
                        echo '<div class=card-subtitle> Date : '.$row['revDate'];
                        echo ' Rating : '.$row['rating'].'<i class="fa fa-star" style="color: #FFD700;"></i></div>';
                        echo 'Comment : '.$row['comment'];
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    }  
                } 
                ?>
   
                
            </div>
            </div>
        </section>
      </div>
    <?php include("../headers/footer.inc.php"); ?>
  </body>
</html>