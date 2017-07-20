<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php
require './vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
require './classes/Config.php';
?>

<?php

$msg = '';

if (isset($_POST['submit'])) {

  $name = escape($_POST['name']);
  $email = escape($_POST['email']);
  $message = wordwrap(escape($_POST['message']), 70);

  $mail = new PHPMailer();
  // Set mailer to use SMTP
  $mail->isSMTP();
  // Specify main and backup SMTP servers
  $mail->Host = Config::SMTP_HOST;
  // Enable SMTP authentication
  $mail->SMTPAuth = true;
  // SMTP username
  $mail->Username = Config::SMTP_USER;
  // SMTP password
  $mail->Password = Config::SMTP_PASSWORD;
  // Enable TLS encryption, `ssl` also accepted
  $mail->SMTPSecure = 'tls';
  // TCP port to connect to
  $mail->Port = Config::SMTP_PORT;
  // Set email format to HTML
  $mail->isHTML(true);

  $mail->setFrom($email, $name);
  $mail->addAddress(Config::ADMIN_EMAIL);

  $mail->Subject = "Message from $name";
  $mail->Body = $message;

  if ($mail->send()) {
    $msg = 'Message sent! Thanks for contacting us.';
  } else {
    $msg = 'Sorry, something went wrong. Please try again later.';
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
              <h4 class="text-center"><?php echo $msg; ?></h4>
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
