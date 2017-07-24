<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php
  require './vendor/autoload.php';
// require './vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
// require './classes/Config.php';

?>

<!-- Navigation -->
<?php  include "includes/navigation.php"; ?>


<?php
  $message = '';

  if (!isset($_GET['forgot'])) {
    redirect('index');
  }

  if (ifItIsMethod('post')) {
    if (isset($_POST['email'])) {
      $email = $_POST['email'];

      $length = 50;

      $token = bin2hex(openssl_random_pseudo_bytes($length));

      if (already_exists('user_email', $email)) {
        $query = "UPDATE users SET token=? WHERE user_email=? ";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "ss", $token, $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        $message = "Please check your email";
      } else {
        $message = "Error - username not found";
      }

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
      $mail->CharSet = 'UTF-8';

      $mail->setFrom('admin@rayarama.com', 'Admin');
      $mail->addAddress($email);

      $mail->Subject = 'Reset Password';
      $mail->Body =
        '<p>
          Please click to reset your password
          <a href="http://localhost/cms/reset.php?email='.$email. '&token='.$token.'">Reset Password</a>
        </p>';
      $mail->AltBody = 'Please click to reset your password';

      if ($mail->send()) {
        echo "Woohoo - Email sent!";
      } else {
        echo "Oops, something went wrong.";
      }
    }
  }
?>

<!-- Page Content -->
<div class="container">

  <div class="form-gap"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="text-center">

              <h3><i class="fa fa-lock fa-4x"></i></h3>
              <h2 class="text-center">Forgot Password?</h2>
              <p>You can reset your password here.</p>
              <div class="panel-body">

                <form id="register-form" role="form" autocomplete="off" class="form" method="post">
                  <h3 class="text-center text-danger"><?php echo $message; ?></h3>
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                      <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                    </div>
                  </div>
                  <div class="form-group">
                    <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                  </div>

                  <input type="hidden" class="hide" name="token" id="token" value="">
                </form>

              </div><!-- Body-->

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <hr>

<?php include "includes/footer.php";?>

</div> <!-- /.container -->
