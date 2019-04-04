<?php
    $currentPage = 'Listing';
    define('id',$_GET['id']);
    if ($_SERVER['QUERY_STRING'] == ''){
    header('Location: index.php?category=All');
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
   </head>
  <body>
    <div id="all">
      <?php include("../headers/header.inc.php");
            require_once("../private/config.php");
            $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
            if (mysqli_connect_errno()) {
                header("Location: ../error/500.php");
                die("Connection failed: " . $conn->connect_error);
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
                             echo '<img src="'.$row['itemPicture'].'" alt="';
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
                              echo'<p class=text-center>Listing End Date : '.$row['ListDate'].'</p>';
                              echo'<p class=text-center>Seller : <a href="profile.php?username='.$row['Seller'].'">'.$row['Seller'].'</a></p>';
                              echo'<p class=text-center>Location : '.$row['TradingLocation'].'</p>';
                              define('Seller',$row['Seller']);
                              $Seller = $row['Seller'];
                              $_SESSION['seller'] = $Seller;
                            }
                            echo '<section class="bg-gray"><div class="row"><div class="col-md-3"></div><div class="col-md-6 mx-auto"><h3 style=text-align:center>Share this listing</h3></div><div class="col-md-3"></div></div>';
                            echo '<div class="row"><div class="col-md-4 col-sm-3"></div><div class="col-md-4 col-sm-4 mx-auto">';
                            echo '<a href="https://www.facebook.com/sharer/sharer.php?u=http://ict1004.ddns.net/dco/Group04/Project2/listing.php?id='.id;
                            echo '" target="_blank"><img src="../img/share-fb.svg" class="img-fluid" width=36 height=36></a>';
                            echo '<a href="https://twitter.com/intent/tweet?url=http://ict1004.ddns.net/dco/Group04/Project2/listing.php?id='.id;
                            echo '" target="_blank"><img src="../img/share-twitter.svg" class="img-fluid" width=36 height=36></a>';
                            echo '<button type="button" class="btn btn-sm btn-link p-0"><img src="../img/share-link.svg" class="img-fluid" width=36 height=36></button>';
                            echo '</div><div class="col-md-3 col-sm-3"></div></div></section>';
                        }
                        
                        ?>
                      <?php
                        if((!empty($_SESSION)) || ($Seller != $_SESSION["username"])) {
                        ?>
                      <p class="text-center" id="user_details">
                        <div id="user_model_details"></div>
                      </p>
                      <?php
                            }
                       ?>
                    </form>
                       <?php if($Seller === $_SESSION["username"]){
                echo '<div class="col-lg-12">
                  <form class=text-center action="editListing.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="targetitem" value='.id.' />
                    <input type="hidden" name="itemcond" value=""/>
                    <input type="hidden" name="itemcat" value=""/>
                    <input type="hidden" name="itemdesc" value=""/>
                    <input type="hidden" name="itemprice" value=""/>
                    <div class="form-group">
                        <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*">                    
                    </div>
                    <button type="submit" class="btn btn-template-outlined" name="upload" value="upload"><i class="fa fa-user-md"></i> Edit Listing</button>
                </form>   
            </div>';
              }?>
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
                <div class="col-lg-12 col-md-12">
                  <div class= "text-uppercase mt-0 mb-small">
                    <h3>Other Products from this Seller</h3>
                  </div>
                </div>
              </div>
              <div class="row">
                <?php
                $othsql="SELECT ItemID,itemPicture,ItemName,Price FROM items where Sold = 0 AND Active= 1 AND Seller ='".Seller."' AND ItemID !=".id;
                if($othresult= mysqli_query($connection,$othsql)){
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
        </div>
      <!-- FOOTER -->
      <?php include("../headers/footer.inc.php"); ?>
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
    <script>  
$(document).ready(function(){
 fetch_user();

 setInterval(function(){
  update_last_activity();
  fetch_user();
  update_chat_history_data();
 }, 3000);

 function fetch_user()
 {
  $.ajax({
   url:"fetch_seller.php",
   method:"POST",
   success:function(data){
    $('#user_details').html(data);
   }
  })
 }

 function update_last_activity()
 {
  $.ajax({
   url:"update_last_activity.php",
   success:function()
   {

   }
  })
 }

 function make_chat_dialog_box(to_user_id, to_user_name)
 {
  var modal_content = '<div id="user_dialog_'+to_user_id+'" class="user_dialog" title="Chatting with '+to_user_name+'">';
  modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
  modal_content += fetch_user_chat_history(to_user_id);
  modal_content += '</div>';
  modal_content += '<div class="form-group">';
  modal_content += '<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control"></textarea>';
  modal_content += '</div><div class="form-group" align="right">';
  modal_content+= '<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat">Send</button></div></div>';
  $('#user_model_details').html(modal_content);
 }

 $(document).on('click', '.start_chat', function(){
  var to_user_id = $(this).data('touserid');
  var to_user_name = $(this).data('tousername');
  make_chat_dialog_box(to_user_id, to_user_name);
  $("#user_dialog_"+to_user_id).dialog({
   autoOpen:false,
   width:400
  });
  $('#user_dialog_'+to_user_id).dialog('open');
 });

 $(document).on('click', '.send_chat', function(){
  var to_user_id = $(this).attr('id');
  var chat_message = $('#chat_message_'+to_user_id).val();
  $.ajax({
   url:"insert_chat.php",
   method:"POST",
   data:{to_user_id:to_user_id, chat_message:chat_message},
   success:function(data)
   {
    $('#chat_message_'+to_user_id).val('');
    $('#chat_history_'+to_user_id).html(data);
   }
  })
 });

 function fetch_user_chat_history(to_user_id)
 {
  $.ajax({
   url:"fetch_user_chat_history.php",
   method:"POST",
   data:{to_user_id:to_user_id},
   success:function(data){
    $('#chat_history_'+to_user_id).html(data);
   }
  })
 }
 
 function update_chat_history_data()
 {
  $('.chat_history').each(function(){
   var to_user_id = $(this).data('touserid');
   fetch_user_chat_history(to_user_id);
  });
 }
});  
</script>
  </body>
</html>
