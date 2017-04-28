<?php include "./includes/admin_header.php" ?>

<?php

  if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username = '{$username}' ";

    $select_user_profile = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_user_profile)) {

      $user_id = $row['user_id'];
      $username = $row['username'];
      $user_password = $row['user_password'];
      $user_firstname = $row['user_firstname'];
      $user_lastname = $row['user_lastname'];
      $user_email = $row['user_email'];
      $user_image = $row['user_image'];
      $user_role = $row['user_role'];

    }
  }

?>

<?php

  if (isset($_POST['edit_user'])) {

    $username = $_POST['username'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    $user_role = $_POST['user_role'];

    move_uploaded_file($user_image_temp, "../images/$user_image");

    if (empty($user_image)) {
      $query = "SELECT * FROM users WHERE user_id = {$user_id_to_edit}";
      $select_image = mysqli_query($connection, $query);

      while($row = mysqli_fetch_array($select_image)) {
        $user_image = $row['user_image'];
      }
    }

    $query = "UPDATE users SET ";
    $query .= "username = '{$username}', ";
    $query .= "user_password = '{$user_password }', ";
    $query .= "user_firstname = '{$user_firstname }', ";
    $query .= "user_lastname = '{$user_lastname }', ";
    $query .= "user_email = '{$user_email }', ";
    $query .= "user_image = '{$user_image}', ";
    $query .= "user_role = '{$user_role}' ";
    $query .= "WHERE user_id = {$user_id} ";

    $edit_user_query = mysqli_query($connection, $query);

    confirmQuery($edit_user_query);

    header("Location: index.php");
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
                <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile">
              </div>

            </form>
          </div> <!-- /.col -->
        </div> <!-- /.row -->
      </div> <!-- /.container-fluid -->
    </div> <!-- /#page-wrapper -->

<?php include "./includes/admin_footer.php" ?>
