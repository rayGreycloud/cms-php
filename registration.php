<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php


  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = escape($_POST['username']);
    $password = escape($_POST['password']);
    $email = escape($_POST['email']);
    $result = register_user($username, $email, $password);

    if ($result['registered']) {
      // Set session values
      $_SESSION['username'] = $username;
      $_SESSION['user_role'] = 'admin';

      session_write_close();
      // Redirect to admin dashboard
      header("Location: ./admin/index.php ");
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
          <h1>Register</h1>
            <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
              <div class="form-group">
                <label for="username" class="sr-only">username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Username" autocomplete="on" value="<?php echo isset($username) ? $username : ''; ?>">

<?php
  if (isset($result['username'])) {
    if ($result['username'] != '') {
      echo "<p class='alert alert-danger'>{$result['username']}</p>";
    }
  }
 ?>
              </div>

               <div class="form-group">
                <label for="email" class="sr-only">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" autocomplete="on" value="<?php echo isset($email) ? $email : ''; ?>">
<?php
  if (isset($result['email'])) {
    if ($result['email'] != '') {
      echo "<p class='alert alert-danger'>{$result['email']}</p>";
    }
  }
 ?>
              </div>

               <div class="form-group">
                <label for="password" class="sr-only">Password</label>
                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
<?php
  if (isset($result['password'])) {
    if ($result['password'] != '') {
      echo "<p class='alert alert-danger'>{$result['password']}</p>";
    }
  }
 ?>
              </div>

              <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
            </form>

          </div>
        </div> <!-- /.col-xs-12 -->
      </div> <!-- /.row -->
    </div> <!-- /.container -->
  </section>

  <hr>

<?php include "includes/footer.php";?>
