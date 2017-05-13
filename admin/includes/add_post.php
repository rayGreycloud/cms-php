<?php
  if (isset($_POST['create_post'])) {

    $post_author = escape($_POST['post_author']);
    $post_title = escape($_POST['post_title']);
    $post_category_id = escape($_POST['post_category_id']);
    $post_status = escape($_POSTescape['post_status']);

    $post_image = escape($_FILES['post_image']['name']);
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    $post_tags = escape($_POST['post_tags']);
    $post_comment_count = 0;
    $post_date = date('d-m-y');
    $post_content = escape($_POST['post_content']);

    move_uploaded_file($post_image_temp, "../images/users/$post_image");

    $query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";

    $query .= "VALUES ('{$post_category_id}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_comment_count}', '{$post_status}') ";

    $create_post_query = mysqli_query($connection, $query);

    confirmQuery($create_post_query);

    $post_id = mysqli_insert_id($connection);

    echo "<p class='bg-success'>Post Created / <a href='./../post.php?p_id={$post_id}'>View Post</a> / <a href='./posts.php'>View All Posts</a></p>";
  }
?>

<form action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="post_author">Author</label>
    <input type="text" class="form-control" name="post_author">
  </div>

  <div class="form-group">
    <label for="post_title">Title</label>
    <input type="text" class="form-control" name="post_title">
  </div>

  <div class="form-group">
    <label for="post_category_id">Category</label>
    <select name="post_category_id" id="">
      <option value="99">Select</option>

<?php

  $query = "SELECT * FROM categories";
  $select_categories_query = mysqli_query($connection, $query);

  while($row = mysqli_fetch_assoc($select_categories_query)) {
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];

    echo "<option value='{$cat_id}'>{$cat_title}</option>";
  }
 ?>

    </select>
  </div>

  <div class="form-group">
    <label for="post_status">Status</label>
    <select name="post_status" id="">
      <option value='draft'>Select</option>
      <option value='draft'>Draft</option>
      <option value='published'>Published</option>
    </select>
  </div>

  <div class="form-group">
    <label for="post_image">Image</label>
    <input type="file" name="post_image">
  </div>

  <div class="form-group">
    <label for="post_tags">Tags</label>
    <input type="text" class="form-control" name="post_tags">
  </div>

  <div class="form-group">
    <label for="post_content">Content</label>
    <textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_post" value="Publish">
  </div>

</form>
