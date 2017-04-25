<?php
  if (isset($_POST['create_user'])) {

    // $post_author = $_POST['post_author'];
    // $post_title = $_POST['post_title'];
    // $post_category_id = $_POST['post_category_id'];
    // $post_status = $_POST['post_status'];
    //
    // $post_image = $_FILES['post_image']['name'];
    // $post_image_temp = $_FILES['post_image']['tmp_name'];
    //
    // $post_tags = $_POST['post_tags'];
    // $post_comment_count = 0;
    // $post_date = date('d-m-y');
    // $post_content = $_POST['post_content'];
    //
    // move_uploaded_file($post_image_temp, "../images/$post_image");
    //
    // $query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
    //
    // $query .= "VALUES ('{$post_category_id}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_comment_count}', '{$post_status}') ";
    //
    // $create_post_query = mysqli_query($connection, $query);
    //
    // confirmQuery($create_post_query);
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
    <label for="user_role">Role</label>
    <select class="form-control" name="user_role" id="">
      <option value="subscriber">Select Role</option>
      <option value="admin">Admin</option>
      <option value="subscriber">Subscriber</option>
    </select>
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
  </div>

</form>
