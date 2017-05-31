<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php

  if (isset($_POST['submit'])) {

    $username = escape($_POST['username']);
    $password = escape($_POST['password']);
    $email = escape($_POST['email']);

    if (username_exists($username)) {
      $message = "That username is not available";
    }

    if (!empty($username) && !empty($email) && !empty($password)) {

      $hashed_pwd = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

      $query = "INSERT INTO users (username, user_password, user_email, user_role) ";
      $query .= "VALUES ('{$username}', '{$hashed_pwd}', '{$email}', 'subscriber') ";
      $register_user_query = mysqli_query($connection, $query);
      confirmQuery($register_user_query);

      $message = "Registration successful";
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
          <h1>Register</h1>
            <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
              <h6 class="text-center"><?php echo $message; ?></h6>
              <div class="form-group">
                <label for="username" class="sr-only">username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Username">
              </div>
               <div class="form-group">
                <label for="email" class="sr-only">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email">
              </div>
               <div class="form-group">
                <label for="password" class="sr-only">Password</label>
                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
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
