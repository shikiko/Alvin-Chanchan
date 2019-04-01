<?php
    $currentPage = 'listing';
    define('id',$_GET['id']);
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
      <link rel="stylesheet" href="../vendor/bootstrap-select/css/bootstrap-select.min.css">
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
      <?php include("../headers/header.inc.php");
            require_once("../private/config.php");
            $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
            if (mysqli_connect_errno()) {
                die(mysqli_connect_errno());
            }
            ?>
      <div id="content">
        <div class="container">
          <div class="row bar">
            <!-- LEFT COLUMN _________________________________________________________-->
            <div class="col-lg-12">
              <div id="productMain" class="row">
                <div class="col-sm-6">
                    <?php
                        $NIsql="SELECT ItemName,itemPicture FROM items where ItemID =  ".id;
                        if($NIresult= mysqli_query($connection,$NIsql)){
                            while ($row = mysqli_fetch_assoc($NIresult)) {
                              echo'<h2>'.$row['ItemName'].'</h2>';
                              if ($row['itemPicture'] == NULL) {
                                echo '<img src="../img/NoImg.png" alt="No Image Available" class="img-fluid image1">';
                                    }
                               else {
                             echo '<img src="data:image/jpg;base64,' . base64_encode($row['itemPicture']) . '" alt="';
                              echo $row['ItemName'];
                              echo '" class="img-fluid image1">';
                               }

                            }
                        }
                    ?>
                </div>
                <div class="col-sm-6">
                  <div class="box">
                    <form>
                        <?php
                        $merSQL="SELECT Seller,Price,itemCond,ListDate,TradingLocation FROM items where ItemID =".id;
                        if($merresult= mysqli_query($connection,$merSQL)){
                            while ($row = mysqli_fetch_assoc($merresult)) {
                              echo'<p class=price>$'.$row['Price'].'</p>';
                              echo'<p class=text-center>Item Condition : '.$row['itemCond'].'</p>';
                              echo'<p class=text-center>List Date : '.$row['ListDate'].'</p>';
                              echo'<p class=text-center>Seller : '.$row['Seller'].'</p>';
                              echo'<p class=text-center>Location : '.$row['TradingLocation'].'</p>';
                              define('Seller',$row['Seller']);
                            }
                        }
                        ?>
                      <p class="text-center">
                        <button type="submit" formaction="inbox.php" method="post" class="btn btn-template-outlined"><i class="fa fa-shopping-cart"></i> Chat now!</button>
                      </p>
                    </form>
                  </div>
                </div>
              </div>
              <div id="details" class="box mb-4 mt-4">
                <?php
                $descsql="SELECT description FROM items where ItemID =  ".id;
                if($descresult= mysqli_query($connection,$descsql)){
                    while ($row = mysqli_fetch_assoc($descresult)) {
                      echo'<h4>Product Description</h4>';
                      echo '<blockquote class=blockquote>';
                      echo $row['description'];
                      echo '</blockquote>';
                    }
                }
                ?>
              </div>                
              <div class="row">
                <div class="col-lg-6 col-md-6">
                  <div class="box text-uppercase mt-0 mb-small">
                    <h3>Other Products from this Seller.</h3>
                      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Show all.
                      </button>
                  </div>
                </div>
              </div>
              <div class="row">
                <?php
                $counter = 0;
                $othsql="SELECT ItemID,itemPicture,ItemName,Price FROM items where Sold = 0 AND Active= 1 AND Seller ='".Seller."' AND ItemID !=".id;
                if($othresult= mysqli_query($connection,$othsql)){
                    while ($row = mysqli_fetch_assoc($othresult)) {
                        if ($counter > 4){
                            echo '<div class="collapse" id="collapseExample">' ;
                        }
                        echo '<div class="col-lg-3 col-md-6">';
                        echo '<div class=product>';
                        echo '<div class=image><a href="listing.php?id='.$row['ItemID'].'">';
                        if ($row['itemPicture'] == NULL) {
                            echo '<img src="../img/NoImg.png" alt="No Image Available" class="img-fluid image1">';
                    }
                        else {
                            echo '<img height=200 src="data:image/jpg;base64,' . base64_encode($row['itemPicture']) . '" alt="';
                            echo $row['ItemName'];
                            echo '" >';
                    }
                              echo '</a></div>';
                        echo '<div class=text>';
                        echo '<h3 class=h5><a href="listing.php?id='.$row['ItemID'].'">'.$row['ItemName'].'</a></h3>';
                        echo '<p class=price>'.$row['Price'].'</p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        $counter ++;
                        
                    }
                    if ($counter >4){
                        echo'</div>';
                    }
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      <!-- FOOTER -->
      <?php include("../headers/footer.inc.php"); ?>
    </div>
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
