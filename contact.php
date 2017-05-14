<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php

$msg = '';

if (isset($_POST['submit'])) {

  require " /PHPMailer/PHPMailerAutoload.php";

  $mail = new PHPMailer;
  $mail->isSMTP();
  $mail->Host = 'localhost';
  $mail->Port = 80;

  $mail->setFrom('from@raygreycloud.com', 'raygreycloud.com');
  $mail->addAddress('raygreycloud@gmail.com', 'Ray Greycloud');


  $name = escape($_POST['name']);
  $email = escape($_POST['email']);
  $message = wordwrap(escape($_POST['message']), 70);

  if ($mail->addReplyTo($email, $name)) {
    $mail->Subject = "Message from <?php echo $name; ?>";
    $mail->isHTML(false);

    $mail->Body = <<<EOT
Email: {$email}
Name: {$name}
Message: {$message}
EOT;

    if (!$mail->send()) {
      $msg = 'Sorry, something went wrong. Please try again later.';
    } else {
      $msg = 'Message sent! Thanks for contacting us.';
    }
  } else {
    $msg = 'Invalid email address, message ignored.';
  }
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
              <h6 class="text-center"><?php echo $msg; ?></h6>
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
                <textarea class="form-control" name="message" id="contact-message" cols="20" rows="8" placeholder="Your Message"></textarea>
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
