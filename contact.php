<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php

  if (isset($_POST['submit'])) {
    $name = escape($_POST['name']);
    $from = escape($_POST['email']);
    $body = wordwrap(escape($_POST['message']), 70);

    $to = "raygreycloud@gmail.com";
    $subject = "Message from <?php echo $name; ?>";
    $headers = "From: <?php echo $from; ?>" . "\r\n";

    if (!empty($contact_name) && !empty($contact_email) && !empty($contact_message)) {

      mail($to,$subject,$body,$headers);

      $message = "Message sent";
    } else {
      $message = "All fields are required";
    }
  } else {
    $message = "";
  }

?>

<!-- Navigation -->
<?php  include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">

  <section id="login">
    <div class="container">
      <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
          <div class="form-wrap">
          <h1>Make Contact</h1>
            <form role="form" action="" method="post" id="contact-form" autocomplete="off">
              <h6 class="text-center"><?php echo $message; ?></h6>
              <div class="form-group">
                <label for="name" class="sr-only">Your Name</label>
                <input type="text" name="name" id="contact-name" class="form-control" placeholder="Your Name">
              </div>
              <div class="form-group">
                <label for="email" class="sr-only">Your Email</label>
                <input type="email" name="email" id="contact-email" class="form-control" placeholder="Your Email">
              </div>
              <div class="form-group">
                <label for="message" class="sr-only">Your Message</label>
                <textarea class="form-control" name="message" id="contact-message" cols="30" rows="6" placeholder="Your Message"></textarea>
              </div>


              <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Send Message">
            </form>

          </div>
        </div> <!-- /.col-xs-12 -->
      </div> <!-- /.row -->
    </div> <!-- /.container -->
  </section>

  <hr>

<?php include "includes/footer.php";?>
