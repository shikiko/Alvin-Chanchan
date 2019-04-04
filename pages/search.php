<?php
$currentPage = 'Search';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="all,follow">
    </head>
  <body>
    <div id="all">
        <?php 
        include ("../headers/header.inc.php");
        require_once ("../private/config.php");
        
        // Create connection
	    $sConn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
	    // Check connection
	    if (!$sConn) {
	      header("Location: ../error/500.php");
	      die("Connection failed: " . $sConn->connect_error);
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
                    <div class="col-md-9 mx-auto">
                        <div class="row">
                        <?php
                        if ($_SERVER['QUERY_STRING'] !== ''){
                            $Squery = $_GET['searchtxt'];
                            $SearchSQL = "SELECT ItemID, ItemName, Seller, Description, Active, Sold FROM items WHERE Active = 1 AND Sold = 0 AND ((ItemName LIKE '%".$Squery."%') OR (Seller LIKE '%".$Squery."%') OR (Description LIKE '%".$Squery."%'))";
                            $RawSearchResults = mysqli_query($sConn, $SearchSQL);
                            if(mysqli_num_rows($RawSearchResults) > 0){
                                while($SearchResults = mysqli_fetch_assoc($RawSearchResults)){
                                    echo '<div class="col-md-9">';
                                    echo '<h3 class="h5"><a href="../pages/listing.php?id=';
                                    echo $SearchResults['ItemID'];
                                    echo '">';
                                    echo $SearchResults['ItemName'];
                                    echo '</a></h3>';
                                    echo '</div>';
                                    echo '<div class="col-md-3 mx-auto"><h3 class="h5">';
                                    echo 'By:   ';
                                    echo '<a href="../pages/profile.php?username=';
                                    echo $SearchResults['Seller'];
                                    echo '">    ';
                                    echo $SearchResults['Seller'];
                                    echo '</a>';
                                    echo '</h3></div>';
                                }
                            }
                            else {
                                $STSQL = "SELECT Username FROM user WHERE Username = '".$Squery."'";
                                $UserSearch = mysqli_query($sConn, $STSQL);
                                if(mysqli_num_rows($UserSearch) > 0){
                                    echo '<div class="col-md-5">';
                                    echo '<h2>Users found:</h2><br>';
                                    while($UserSearchResults = mysqli_fetch_assoc($UserSearch)){
                                        echo '<h3 class="h5"><a href="../pages/profile.php?username=';
                                        echo $UserSearchResults['Username'];
                                        echo '">';
                                        echo $UserSearchResults['Username'];
                                        echo '</a></h3>';
                                    }
                                }
                                else{
                                    echo '<h3>No Results</h3>';
                                }
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
  </body>
</html>