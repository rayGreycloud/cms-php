<?php include "./includes/admin_header.php" ?>

<?php

  if (isset($_SESSION['username'])) {

    $username = $_SESSION['username'];

    $query = "SELECT user_id, username, user_password, user_firstname, user_lastname, user_email, user_image, user_role ";
    $query .= "FROM users WHERE username = ?";

    $stmt = mysqli_prepare($connection, $query);

    mysqli_stmt_bind_param($stmt, "s", $username);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $user_id, $username, $user_password, $user_firstname, $user_lastname, $user_email, $user_image, $user_role);

    mysqli_stmt_store_result($stmt);

    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if (!$user_image) {
      $user_image = 'placeholder-user.png';
    }
  }
 ?>

<?php

  if (isset($_POST['edit_user'])) {

    $username = escape($_POST['username']);
    $user_password = escape($_POST['user_password']);
    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);
    $user_email = escape($_POST['user_email']);
    $user_image = escape($_FILES['user_image']['name']);
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    $user_role = escape($_POST['user_role']);

    move_uploaded_file($user_image_temp, "../images/user/$user_image");

    $query = "UPDATE users SET ";
    $query .= "username=?, ";
    $query .= "user_password=?, ";
    $query .= "user_firstname=?, ";
    $query .= "user_lastname=?, ";
    $query .= "user_email=?, ";
    $query .= "user_image=?, ";
    $query .= "user_role=? ";
    $query .= "WHERE user_id=?";

    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "sssssssd", $username, $user_password, $user_firstname, $user_lastname, $user_email, $user_image, $user_role, $user_id);

    mysqli_stmt_execute($stmt);
    confirmQuery($stmt);

    mysqli_stmt_close($stmt);

    redirect("/index.php");
  }

?>


  <div id="wrapper">

    <!-- Navigation -->
<?php include "./includes/admin_navigation.php" ?>

    <div id="page-wrapper">

      <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header">
              Profile
              <small> <?php echo $_SESSION['username']; ?></small>
            </h1>

            <form action="" method="post" enctype="multipart/form-data">

              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" value="<?php echo $username ?>">
              </div>

              <div class="form-group">
                <label for="user_password">Password</label>
                <input type="password" class="form-control" name="user_password" value="<?php echo $user_password ?>">
              </div>

              <div class="form-group">
                <label for="user_firstname">Firstname</label>
                <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname ?>">
              </div>

              <div class="form-group">
                <label for="user_lastname">Lastname</label>
                <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname ?>">
              </div>

              <div class="form-group">
                <label for="user_email">Email</label>
                <input type="text" class="form-control" name="user_email" value="<?php echo $user_email ?>">
              </div>

              <div class="form-group">
                <label for="user_image">Image</label>
                <img width='100rem' src="../images/user/<?php echo $user_image; ?>" alt="">
                <input type="file" name="user_image">
              </div>

              <div class="form-group">
                <label for="user_role">Role</label>
                <select class="form-control" name="user_role" id="">
                  <option value="<?php echo $user_role ?>"><?php echo $user_role ?></option>
                  <option value="admin">admin</option>
                  <option value="subscriber">subscriber</option>
                </select>
              </div>

              <div class="form-group">
                <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile">
              </div>

            </form>
          </div> <!-- /.col -->
        </div> <!-- /.row -->
      </div> <!-- /.container-fluid -->
    </div> <!-- /#page-wrapper -->

<?php include "./includes/admin_footer.php" ?>
