<?php
  if (isset($_GET['edit_user'])) {

    $user_id_to_edit = $_GET['edit_user'];

    $query = "SELECT * FROM users WHERE user_id = $user_id_to_edit ";
    $get_user_to_edit_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($get_user_to_edit_query)) {
      $username = $row['username'];
      $user_password = $row['user_password'];
      $user_firstname = $row['user_firstname'];
      $user_lastname = $row['user_lastname'];
      $user_email = $row['user_email'];
      $user_image = $row['user_image'];
      $user_role = $row['user_role'];

    }

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

      $query = "SELECT randSalt FROM users";
      $select_randsalt_query = mysqli_query($connection, $query);
      if (!$select_randsalt_query) {
        die("Query failed" . mysqli_error($connection));
      }
      $row = mysqli_fetch_array($select_randsalt_query);
      $salt = $row['randSalt'];
      $hashed_pwd = crypt($user_password, $salt);

      $query = "UPDATE users SET ";
      $query .= "username = '{$username}', ";
      $query .= "user_password = '{$hashed_pwd }', ";
      $query .= "user_firstname = '{$user_firstname }', ";
      $query .= "user_lastname = '{$user_lastname }', ";
      $query .= "user_email = '{$user_email }', ";
      $query .= "user_image = '{$user_image}', ";
      $query .= "user_role = '{$user_role}' ";
      $query .= "WHERE user_id = {$user_id_to_edit} ";

      $edit_user_query = mysqli_query($connection, $query);

      confirmQuery($edit_user_query);

      header("Location: users.php");
    }
  }

?>

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
    <label for="user_role">Role</label>
    <select class="form-control" name="user_role" id="">
      <option value="<?php echo $user_role ?>"><?php echo ucfirst($user_role) ?></option>
      <option value="admin">Admin</option>
      <option value="subscriber">Subscriber</option>
    </select>
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
    <input class="btn btn-primary" type="submit" name="edit_user" value="Update User">
  </div>

</form>
