<?php
$currentPage = 'Contact Us';
require_once("../php_scripts/contactMail.php");
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
      <?php
      include ('../headers/header.inc.php');
      ?>
      <div id="content">
        <div id="contact" class="container">
          <section class="bar">
            <div class="row">
              <div class="col-md-12">
                <div class="heading">
                  <h2>We are here to help you</h2>
                </div>
                <p class="lead">Need help with something? Drop us an email with your question!</p>
                <p class="text-sm">Please feel free to contact us, we will get back to you as soon as we can.</p>
              </div>
            </div>
          </section>
          <section class="bar pt-0">
            <div class="row">
              <div class="col-md-12">
                <div class="heading text-center">
                  <h2>Contact form</h2>
                </div>
              </div>
              <div class="col-md-8 mx-auto">
                  <?php if($ContactSuccess == true){ echo '<div role="alert" class="alert alert-success">We have received your email. We will try to get back to your as soon as possible.</div>';}?>
                  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" name="contactusform">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input id="firstname" type="text" class="form-control" name="CFname" required maxlength="50">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input id="lastname" type="text" class="form-control" name="CLname" required maxlength="50">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="text" class="form-control" name="Cemail" required maxlength="80">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="subject">Subject</label>
                        <input id="subject" type="text" class="form-control" name="Csubject" required maxlength="50">
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" class="form-control" name="Cmessage" required maxlength="1000"></textarea>
                      </div>
                    </div>
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-template-outlined" value="Csubmit" name="Csubmit"><i class="fa fa-envelope-o"></i> Send message</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </section>
        </div>
        <?php
        include ('../headers/footer.inc.php');
        ?>
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