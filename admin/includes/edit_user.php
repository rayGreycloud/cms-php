<?php
  if (isset($_GET['edit_user'])) {

    $user_id_to_edit = $_GET['edit_user'];

    $query = "SELECT * FROM users WHERE user_id = $user_id_to_edit ";
    $get_user_to_edit_query = mysqli_query($connection, $query);
    confirmQuery($get_user_to_edit_query);
    
    while ($row = mysqli_fetch_assoc($get_user_to_edit_query)) {
      $db_username = $row['username'];
      $db_user_password = $row['user_password'];
      $db_user_firstname = $row['user_firstname'];
      $db_user_lastname = $row['user_lastname'];
      $db_user_email = $row['user_email'];
      $db_user_image = $row['user_image'];
      $db_user_role = $row['user_role'];

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
        $select_image_query = mysqli_query($connection, $query);
        confirmQuery($select_image_query);

        while ($row = mysqli_fetch_array($select_image_query)) {
          $user_image = $row['user_image'];
        }
      }

      if (!empty($user_password)) {
        $user_password = $db_user_password;
      }

      $hashed_pwd = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));

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
  } else {
    header("Location: index.php");
  }

?>

<form action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username" value="<?php echo $db_username ?>">
  </div>

  <div class="form-group">
    <label for="user_password">Password</label>
    <input type="password" class="form-control" name="user_password" value="<?php echo $db_user_password ?>">
  </div>

  <div class="form-group">
    <label for="user_role">Role</label>
    <select class="form-control" name="user_role" id="">
      <option value="<?php echo $db_user_role ?>"><?php echo ucfirst($db_user_role) ?></option>
      <option value="admin">Admin</option>
      <option value="subscriber">Subscriber</option>
    </select>
  </div>

  <div class="form-group">
    <label for="user_firstname">Firstname</label>
    <input type="text" class="form-control" name="user_firstname" value="<?php echo $db_user_firstname ?>">
  </div>

  <div class="form-group">
    <label for="user_lastname">Lastname</label>
    <input type="text" class="form-control" name="user_lastname" value="<?php echo $db_user_lastname ?>">
  </div>

  <div class="form-group">
    <label for="user_email">Email</label>
    <input type="text" class="form-control" name="user_email" value="<?php echo $db_user_email ?>">
  </div>

  <div class="form-group">
    <label for="user_image">Image</label>
    <img width='100rem' src="../images/<?php echo $db_user_image; ?>" alt="">
    <input type="file" name="user_image">
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="edit_user" value="Update User">
  </div>

</form>
