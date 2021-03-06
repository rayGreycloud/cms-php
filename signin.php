<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<?php
  $message = '';

  if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $user_auth = authenticate_user($username, $password);

    if ($user_auth != '') {

      $_SESSION['username'] = $username;
      $_SESSION['user_role'] = $user_auth;

      session_write_close();

      header("Location: ./admin/index.php ");
    } else {
      $message = "Error - username and/or password are incorrect";
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
            <h1>Sign in</h1>
            <form action="/cms/signin.php" method="post">
              <h3 class="text-center text-danger"><?php echo $message; ?></h3>
              <div class="form-group">
                <input name="username" type="text" class="form-control" placeholder="Enter Username">
              </div>
              <div class="form-group">
                <input name="password" type="password" class="form-control" placeholder="Enter Password">
              </div>

              <button name="login" class="btn btn-custom btn-lg btn-block" type="submit">Sign in</button>

            </form>
            <div class="col-lg-12 text-center text-muted">
              <a href="./forgot_password.php?forgot=<?php echo uniqid(true); ?>"><h5>Forgot your password?</h5></a>
              <h5>Need an account? <a href="./registration.php">Register here</h5></a>
            </div>


          </div>
        </div> <!-- /.col-xs-12 -->
      </div> <!-- /.row -->
    </div> <!-- /.container -->
  </section>

  <hr>

<?php include "includes/footer.php";?>
