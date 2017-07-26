<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php
  // if (!isset($_GET['email']) || !isset($_GET['token'])) {
  //   redirect('index');
  // }
 ?>

<?php
// Set user token for testing
$token = 'a900e0c43887ac9a1b586614bb35f314feace0ca79591fecb6755ca00827e9b524a6a79ba7904864bc040293ebec337c63c3';

$query = 'SELECT username, user_email, token FROM USERS WHERE token=? ';
if ($stmt = mysqli_prepare($connection, $query)) {
  echo "Query working...";
  mysqli_stmt_bind_param($stmt, "s", $token);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $username, $user_email, $token);
  mysqli_stmt_fetch($stmt);
  mysqli_stmt_close($stmt);

  echo $username;
}
 ?>
<!-- Navigation -->
<?php  include "includes/navigation.php"; ?>

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
              <h2 class="text-center">Reset Password?</h2>
              <p>You can reset your password here.</p>
              <div class="panel-body">
                <form id="register-form" role="form" autocomplete="off" class="form" method="post">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                      <input id="password" name="password" placeholder="Enter new password" class="form-control"  type="password">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-check"></i></span>
                      <input id="confirmPassword" name="confirmPassword" placeholder="Confirm new password" class="form-control"  type="password">
                    </div>
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
