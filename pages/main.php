<?php
$currentPage = 'Home';
if ($_SERVER['QUERY_STRING'] == ''){
    header('Location: main.php?category=All');
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
            include("../headers/header.inc.php");
            require_once("../private/config.php");
            // Create connection
	    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
	    // Check connection
	    if (!$connection) {
	      header("Location: ../error/500.php");
	      die("Connection failed: " . $connection->connect_error);
            }
            $currentCat = explode("=", $_SERVER['QUERY_STRING']);
            $CatType = $currentCat[1];
            if ($CatType == 'HomeAppliances') {
                $FCatType = 'Home Appliances';
            } else if ($CatType == 'ComputersAndIT') {
                $FCatType = 'Computers and IT';
            } else if ($CatType == 'All') {
                $FCatType = 'All';
            } else if ($CatType == 'Furniture') {
                $FCatType = 'Furniture';
            } else if ($CatType == 'Kids') {
                $FCatType = 'Kids';
            } else if ($CatType == 'HomeRepairsAndServices') {
                $FCatType = 'Home Repairs and Services';
            }
            ?>
            <div id="content">
                <div class="container">
                    <div class="row bar">
                        <div class="col-md-9">
                            <p class="text-muted lead">Browse what others are listing now!</p>
                            <div class="row products products-big">
<?php
        if ($FCatType == 'All') {
            $sql = "SELECT ItemID, ItemName, Category, Price, Active, Sold, itemPicture FROM items WHERE Sold = 0 AND Active = 1";
            if ($result = mysqli_query($connection, $sql)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="col-lg-4 col-md-6">';
                    echo '<div class="product">';
                    echo '<div class="image"><a href="listing.php?id=';
                    echo $row['ItemID'];
                    echo '">';
                    if ($row['itemPicture'] == NULL) {
                        echo '<img src="../img/NoImg.png" alt="No Image Available" class="img-fluid image1">';
                    }
                    else {
                        echo '<img src="'.$row['itemPicture'].'" alt="';
                        echo $row['ItemName'];
                        echo '" class="img-fluid image1">';
                    }
                    echo '</div>';
                    echo '<div class="text">';
                    echo '<h3 class=h5>';
                    echo $row['ItemName'];
                    echo '</h3>';
                    echo '<p class="price">';
                    echo '$';
                    echo $row['Price'];
                    echo '</p>';
                    echo '</div></div></div>';
                }
            }
        } 
        else {
            $selectiveSQL = "SELECT ItemID, ItemName, Category, Price, Active, Sold, itemPicture FROM items WHERE Sold = 0 AND Active = 1 AND Category ='" . $FCatType . "'";
            if ($selectiveresult = mysqli_query($connection, $selectiveSQL)) {
                while ($selectiveRow = mysqli_fetch_assoc($selectiveresult)) {
                    echo '<div class="col-lg-4 col-md-6">';
                    echo '<div class="product">';
                    echo '<div class="image"><a href="listing.php?id=';
                    echo $selectiveRow['ItemID'];
                    echo '">';
                   if ($selectiveRow['itemPicture'] == NULL) {
                        echo '<img src="../img/NoImg.png" alt="No Image Available" class="img-fluid image1">';
                    }
                    else {
                        echo '<img src="'.$row['itemPicture'].'" alt="';
                        echo $selectiveRow['ItemName'];
                        echo '" class="img-fluid image1">';
                    }
                    echo '</div>';
                    echo '<div class="text">';
                    echo '<h3 class=h5>';
                    echo $selectiveRow['ItemName'];
                    echo '</h3>';
                    echo '<p class="price">';
                    echo '$';
                    echo $selectiveRow['Price'];
                    echo '</p>';
                    echo '</div></div></div>';
                }
            }
        }
?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- MENUS AND FILTERS-->
                            <div class="panel panel-default sidebar-menu">
                                <div class="panel-heading">
                                    <h3 class="h4 panel-title">Categories</h3>
                                </div>
                                <div class="panel-body">
                                    <ul class="nav nav-pills flex-column text-sm category-menu">
                                        <li class="nav-item">
                                            <a href="main.php?category=All" class="nav-link d-flex align-items-center justify-content-between"><span>All</span><span class="badge badge-secondary">
                                            <?php
                                            $Asql = "SELECT COUNT(*) FROM items WHERE Sold = 0 AND Active = 1";
                                            if ($Aresult = mysqli_query($connection, $Asql)) {
                                                while ($Arow = mysqli_fetch_assoc($Aresult)) {
                                                    echo $Arow['COUNT(*)'];
                                                }
                                            }
                                            ?>
                                                </span></a>
                                            <ul class="nav nav-pills flex-column">
                                                <li class="nav-item"><a href="main.php?category=HomeAppliances" class="nav-link">Home Appliances
                                                        <span class="badge badge-secondary">
                                                    <?php
                                                    $HAsql = "SELECT COUNT(*) FROM items WHERE Category = 'Home Appliances' AND Sold = 0 AND Active = 1";
                                                    if ($HAresult = mysqli_query($connection, $HAsql)) {
                                                        while ($HArow = mysqli_fetch_assoc($HAresult)) {
                                                            echo $HArow['COUNT(*)'];
                                                        }
                                                    }
                                                    ?>
                                                        </span></a></li>
                                                <li class="nav-item"><a href="main.php?category=Furniture" class="nav-link">Furniture
                                                        <span class="badge badge-secondary">
                                                            <?php
                                                            $Fsql = "SELECT COUNT(*) FROM items WHERE Category = 'Furniture' AND Sold = 0 AND Active = 1";
                                                            if ($Fresult = mysqli_query($connection, $Fsql)) {
                                                                while ($Frow = mysqli_fetch_assoc($Fresult)) {
                                                                    echo $Frow['COUNT(*)'];
                                                                }
                                                            }
                                                            ?>
                                                        </span></a></li>
                                                <li class="nav-item"><a href="main.php?category=ComputersAndIT" class="nav-link">Computers and IT
                                                        <span class="badge badge-secondary">
                                                            <?php
                                                            $CITsql = "SELECT COUNT(*) FROM items WHERE Category = 'Computers and IT' AND Sold = 0 AND Active = 1";
                                                            if ($CITresult = mysqli_query($connection, $CITsql)) {
                                                                while ($CITrow = mysqli_fetch_assoc($CITresult)) {
                                                                    echo $CITrow['COUNT(*)'];
                                                                }
                                                            }
                                                            ?>
                                                        </span></a></li>
                                                <li class="nav-item"><a href="main.php?category=Kids" class="nav-link">Kids
                                                        <span class="badge badge-secondary">
                                                            <?php
                                                            $Ksql = "SELECT COUNT(*) FROM items WHERE Category = 'Kids' AND Sold = 0 AND Active = 1";
                                                            if ($Kresult = mysqli_query($connection, $Ksql)) {
                                                                while ($Krow = mysqli_fetch_assoc($Kresult)) {
                                                                    echo $Krow['COUNT(*)'];
                                                                }
                                                            }
                                                            ?>
                                                        </span></a></li>
                                                <li class="nav-item"><a href="main.php?category=HomeRepairsAndServices" class="nav-link">Home Repairs & Services
                                                        <span class="badge badge-secondary">
                                                            <?php
                                                            $RSsql = "SELECT COUNT(*) FROM items WHERE Category = 'Home Repairs and Services' AND Sold = 0 AND Active = 1";
                                                            if ($RSresult = mysqli_query($connection, $RSsql)) {
                                                                while ($RSrow = mysqli_fetch_assoc($RSresult)) {
                                                                    echo $RSrow['COUNT(*)'];
                                                                }
                                                            }
                                                            ?>
                                                        </span></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php include("../headers/footer.inc.php"); ?>
        </div>
        <!-- Javascript files-->
        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/popper.js/umd/popper.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="../vendor/jquery.cookie/jquery.cookie.js"></script>
        <script src="../vendor/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="../vendor/jquery.counterup/jquery.counterup.min.js"></script>
        <script src="../vendor/owl.carousel/owl.carousel.min.js"></script>
        <script src="../vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js"></script>
        <script src="../js/jquery.parallax-1.1.3.js"></script>
        <script src="../vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
        <script src="../vendor/jquery.scrollto/jquery.scrollTo.min.js"></script>
        <script src="../js/front.js"></script>
    </body>
</html>