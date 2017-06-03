<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php
  $message = '';

  if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    login_user($username, $password);
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
            <h1>Login</h1>
            <form action="/signin.php" method="post">
              <h3 class="text-center text-danger"><?php echo $message; ?></h3>
              <div class="form-group">
                <input name="username" type="text" class="form-control" placeholder="Enter Username">
              </div>
              <div class="input-group">
                <input name="password" type="password" class="form-control" placeholder="Enter Password">
                <span class="input-group-btn">
                  <button name="login" class="btn btn-primary" type="submit">Login</button>
                </span>
              </div>
            </form>
            <div class="col-lg-12 text-center text-info">
              <a href="./registration.php">Register Here</a>
            </div>


          </div>
        </div> <!-- /.col-xs-12 -->
      </div> <!-- /.row -->
    </div> <!-- /.container -->
  </section>

  <hr>

<?php include "includes/footer.php";?>
