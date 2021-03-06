<?php
  if (isset($_POST['create_user'])) {

    $username = escape($_POST['username']);
    $user_password = escape($_POST['user_password']);
    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);
    $user_email = escape($_POST['user_email']);
    $user_image = escape($_FILES['user_image']['name']);
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    $user_role = escape($_POST['user_role']);

    move_uploaded_file($user_image_temp, "../images/user/$user_image");

    $hashed_pwd = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));

    $query = "INSERT INTO users (username, user_password, user_firstname, user_lastname, user_email, user_image, user_role) ";

    $query .= "VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $query);

    mysqli_stmt_bind_param($stmt, 'sssssss', $username, $hashed_pwd, $user_firstname, $user_lastname, $user_email, $user_image, $user_role);

    mysqli_stmt_execute($stmt);
    confirmQuery($stmt);
    mysqli_stmt_close($stmt);

    // $query .= "VALUES ('{$username}', '{$hashed_pwd}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_image}', '{$user_role}') ";
    //
    // $create_user_query = mysqli_query($connection, $query);
    //
    // confirmQuery($create_user_query);

    redirect("users.php");
  }
?>

<form action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username">
  </div>

  <div class="form-group">
    <label for="user_password">Password</label>
    <input type="password" class="form-control" name="user_password">
  </div>

  <div class="form-group">
    <label for="user_role">Role</label>
    <select class="form-control" name="user_role" id="">
      <option value="subscriber">Select Role</option>
      <option value="admin">Admin</option>
      <option value="subscriber">Subscriber</option>
    </select>
  </div>

  <div class="form-group">
    <label for="user_firstname">Firstname</label>
    <input type="text" class="form-control" name="user_firstname">
  </div>

  <div class="form-group">
    <label for="user_lastname">Lastname</label>
    <input type="text" class="form-control" name="user_lastname">
  </div>

  <div class="form-group">
    <label for="user_email">Email</label>
    <input type="text" class="form-control" name="user_email">
  </div>

  <div class="form-group">
    <label for="user_image">Image</label>
    <input type="file" name="user_image">
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
  </div>

</form>
