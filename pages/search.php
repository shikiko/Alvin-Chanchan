<?php
$currentPage = 'search';
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
        <?php 
        include ("../headers/header.inc.php");
        require_once ("../private/config.php");
        
        $sConn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
        if (mysqli_connect_errno()) {
                die(mysqli_connect_errno());
            }
        ?>
      <div id="content">
        <div id="contact" class="container">
          <section class="bar">
            <div class="row">
              <div class="col-md-12">
                <div class="heading">
                  <h2>Trying to find something?</h2>
                </div>
              </div>
            </div>
          </section>
          <section class="bar pt-0">
            <div class="row">
              <div class="col-md-10 mx-auto">
                  <form role="search" class="navbar-form" action="search.php" method="GET">
                      <div class="input-group">
                          <input type="text" placeholder="Search" class="form-control" name="searchtxt"><span class="input-group-btn">
                              <button type="submit" class="btn btn-template-main" value="Searchbtn"><i class="fa fa-search"></i></button></span>
                      </div>
                  </form>
              </div>
            </div>
          </section>
            <section class="bar">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <div class="row">
                        <?php
                        if ($_SERVER['QUERY_STRING'] !== ''){
                            $Squery = $_GET['searchtxt'];
                            $SearchSQL = "SELECT ItemID, ItemName, Seller, Description FROM items WHERE (ItemName LIKE '%".$Squery."%') OR (Seller LIKE '%".$Squery."%') OR (Description LIKE '%".$Squery."%')";
                            $RawSearchResults = mysqli_query($sConn, $SearchSQL);
                            if(mysqli_num_rows($RawSearchResults) > 0){
                                while($SearchResults = mysqli_fetch_assoc($RawSearchResults)){
                                    echo '<div class="col-md-8">';
                                    echo '<h4><a href="listing.php?id=';
                                    echo $SearchResults['ItemID'];
                                    echo '">';
                                    echo $SearchResults['ItemName'];
                                    echo '</a></h4>';
                                    echo '</div>';
                                    echo '<div class="col-md-4 mx-auto"><h4>';
                                    echo 'By: ';
                                    echo $SearchResults['Seller'];
                                    echo '</h4></div>';
                                }
                            }
                            else {
                                echo '<h3>No Results</h3>';
                            }
                        }
                        ?>
                            </div>
                    </div>
                </div>
            </section>
        </div>
      </div>
<?php include ("../headers/footer.inc.php"); ?>
    </div>
    <!-- Javascript files-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/popper.js/umd/popper.min.js"> </script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="../vendor/waypoints/lib/jquery.waypoints.min.js"> </script>
    <script src="../vendor/jquery.counterup/jquery.counterup.min.js"> </script>
    <script src="../vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="../vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js"></script>
    <script src="../js/jquery.parallax-1.1.3.js"></script>
    <script src="../vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
    <script src="../vendor/jquery.scrollto/jquery.scrollTo.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu5nZKbeK-WHQ70oqOWo-_4VmwOwKP9YQ"></script>
    <script src="../js/gmaps.js"></script>
    <script src="../js/gmaps.init.js"></script>
    <script src="../js/front.js"></script>
  </body>
</html>