<?php include "./includes/admin_header.php" ?>

<?php

  if (isset($_SESSION['username'])) {
    echo $_SESSION['username'];
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
              <small>Admin</small>
            </h1>

            <ol class="breadcrumb">
              <li>
                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
              </li>
              <li class="active">
                <i class="fa fa-file"></i> Blank Page
              </li>
            </ol>

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
                <img width='100rem' src="../images/<?php echo $user_image; ?>" alt="">
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
                <input class="btn btn-primary" type="submit" name="edit_user" value="Update User">
              </div>

            </form>
          </div> <!-- /.col -->
        </div> <!-- /.row -->
      </div> <!-- /.container-fluid -->
    </div> <!-- /#page-wrapper -->

<?php include "./includes/admin_footer.php" ?>
