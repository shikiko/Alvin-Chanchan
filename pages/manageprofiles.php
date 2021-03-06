<?php 
  require("../php_scripts/functions.php");
   if(!isset($_SESSION["username"])){
    session_start();
        $username = $_SESSION["username"];
        if(!CheckAdmin($username)){
            header("Location: ../error/401.php");
            }
        }
  $currentPage = 'Admin Page';
  include("../headers/header.inc.php");
  require_once("../private/config.php");
  require("../php_scripts/admin_functions.php");
?>

<!DOCTYPE html>
<html>
  <head>
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
       <div class="row">
        <div class="col-md-1"></div>
           <div class="col-md-10">
            <?php if($error != ""){echo '<div role="alert" class="alert alert-danger">'.$error.'</div>';}
            if($success != ""){echo '<div role="alert" class="alert alert-success">'.$success.'</div>';}?>
            <br>
             <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search for names.."> 
             <br>
               <div class="row" style="overflow-y:auto;">
                     <table class="table" id="myTable">
                        <thead>
                          <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Cotact Number</th>
                            <th>Gender</th>
                            <th>Verified</th>
                            <th width="7%"></th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result  = GetUserData();
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td>'.$row["Username"].'</td>';
                                    echo '<td>'.$row["Email"].'</td>';
                                    echo '<td>';
                                    if ($row["ContactNumber"] == ''){echo "Not Set";}else{echo $row["ContactNumber"];};
                                    echo '</td>';
                                    echo '<td>';
                                    if ($row["Gender"] == ''){echo "Not Set";}else{echo $row["Gender"];};
                                    echo '</td>';
                                    echo '<td>';
                                    if ($row["verified"] == 0){echo "Not Verified";}else{echo 'Verified';};
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<button data-toggle="modal" data-target="#'.$row["Username"].'" class="btn btn-template-outlined">
                                <i class="fa fa-pencil"></i> Edit</button>';
                                  if($row["admin"] != 1){
                                    echo '<form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]). '" >';
                                    echo '<input id="username-login" type="hidden" class="form-control" name="username" value="'.$row["Username"].'"> <br>';
                                    echo '<button type="submit" class="btn btn-template-outlined" name="delete" value="delete">Delete</button>';
                                    echo '</form>';
                                  }
                                    echo '</td>';
                                    echo '<td>';
                                    echo '</td>';
                                    echo '<div id="'.$row["Username"].'" tabindex="-1" role="dialog" aria-labelledby="e-modalLabel" aria-hidden="true" class="modal fade">
                                       <div role="document" class="modal-dialog">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h4 id="e-modalLabel" class="modal-title">Edit Details</h4>
                                                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                                             </div>
                                             <div class="modal-body">
                                                  <form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]). '" >
                                                   <div class="form-group">
                                                      <input id="username-login" type="hidden" class="form-control" name="username" value="'.$row["Username"].'">
                                                  <div class="form-group">
                                                      <input id="email-login" type="text" class="form-control" name="email" placeholder="Email" value="'.$row["Email"].'">
                                                      <span class="error"><?php if(!empty($EmailErr)){echo $EmailErr;}?></span> 
                                                   </div>
                                                   <div class="form-group">
                                                      <span class="error"><?php if(!empty($ContactErr)){echo $ContactErr;}?></span>   
                                                      <input id="email-login" type="text" class="form-control" name="Contact" placeholder="Contact" value="'.$row["ContactNumber"].'">
                                                   </div>
                                                  <div class="form-group">
                                                    <select id="gender" class="form-control" name="gender">
                                                      <option value="Unset">Change Gender</option>
                                                      <option value="Male">Male</option>
                                                      <option value="Female">Female</option>
                                                    </select>
                                                  </div>
                                                  <div class="form-group">
                                                    <select id="verified" class="form-control" name="verified">
                                                      <option value="2">Change Email Verified State</option>
                                                      <option value="1">Verified</option>
                                                      <option value="0">Not Verified</option>
                                                    </select>
                                                  </div>
                                                   <p class="text-center">
                                                      <button type="submit" class="btn btn-template-outlined" name="edit_modal" value="edit_modal"><i class="fa fa-save"></i> Save</button>
                                                   </p>
                                                </form>
                                             </div>
                                          </div>
                                       </div>
                                    </div>';       
                               }
                            }                        
                            ?>
                        </tbody>
                            </table>
  <div class="col-md-1"></div>
               </div>
           </div>
       </div>       
      </div>
    </div>
        <?php
        include ('../headers/footer.inc.php');
        ?>
    <!-- Javascript files-->
    <script type="text/javascript">  
    function myFunction() {
      // Declare variables
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");

      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
    </script>
    <script src="//code.jquery.com/jquery.min.js"></script> <script type="text/javascript">
    </script>
    <script src="../thirdpartyvendors/jquery.tabledit.js"></script>
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