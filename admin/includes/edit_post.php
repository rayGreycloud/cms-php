<?php
  if (isset($_GET['p_id'])) {

    $post_id_to_edit = escape($_GET['p_id']);

    $query = "SELECT * FROM posts WHERE post_id = {$post_id_to_edit}";
    $get_post_to_edit_query = mysqli_query($connection, $query);
    confirmQuery($get_post_to_edit_query);

    while($row = mysqli_fetch_assoc($get_post_to_edit_query)) {
      $post_id = $row['post_id'];
      $post_author = $row['post_author'];
      $post_title = $row['post_title'];
      $post_category_id = $row['post_category_id'];
      $post_status = $row['post_status'];
      $post_image = $row['post_image'];
      $post_tags = $row['post_tags'];
      $post_comment_count = $row['post_comment_count'];
      $post_date = $row['post_date'];
      $post_content = $row['post_content'];

    }

    if (isset($_POST['update_post'])) {

      $post_author = escape($_POST['post_author']);
      $post_title = escape($_POST['post_title']);
      $post_category_id = escape($_POST['post_category_id']);
      $post_status = escape($_POST['post_status']);
      $post_image = escape($_FILES['post_image']['name']);
      $post_image_temp = $_FILES['post_image']['tmp_name'];
      $post_tags = escape($_POST['post_tags']);
      $post_content = escape($_POST['post_content']);

      move_uploaded_file($post_image_temp, "../images/user/$post_image");

      if (empty($post_image)) {
        $query = "SELECT * FROM posts WHERE post_id = {$post_id_to_edit}";
        $select_image = mysqli_query($connection, $query);

        while($row = mysqli_fetch_array($select_image)) {
          $post_image = $row['post_image'];
        }
      }

      $query = "UPDATE posts SET ";
      $query .= "post_title = '{$post_title}', ";
      $query .= "post_category_id = '{$post_category_id}', ";
      $query .= "post_author = '{$post_author}', ";
      $query .= "post_date = now(), ";
      $query .= "post_image = '{$post_image}', ";
      $query .= "post_content = '{$post_content}', ";
      $query .= "post_tags = '{$post_tags}', ";
      $query .= "post_status = '{$post_status}' ";
      $query .= "WHERE post_id = $post_id_to_edit ";

      $update_post_query = mysqli_query($connection, $query);
      confirmQuery($update_post_query);

      echo "<p class='bg-success'>Post Updated / <a href='./../post.php?p_id={$post_id_to_edit}'>View Post</a> / <a href='./posts.php'>View All Posts</a></p>";

    }
  }

?>

<form action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="post_author">Author</label>
    <input type="text" class="form-control" name="post_author" value="<?php echo $post_author; ?>">
  </div>

  <div class="form-group">
    <label for="post_title">Title</label>
    <input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>">
  </div>

  <div class="form-group">
    <label for="post_category_id">Category</label>
    <select name="post_category_id" id="">

<?php

  $query = "SELECT * FROM categories";
  $select_categories_query = mysqli_query($connection, $query);
  confirmQuery($select_categories_query);

  while($row = mysqli_fetch_assoc($select_categories_query)) {
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];

    if ($cat_id == $post_category_id) {
      echo "<option selected value='$cat_id'>{$cat_title}</option>";
    } else {
      echo "<option value='$cat_id'>{$cat_title}</option>";
    }
  }

 ?>

    </select>
  </div>

  <div class="form-group">
    <label for="post_status">Status</label>
    <select name="post_status" id="">
<?php
  $current_post_status = ucfirst($post_status);

  echo "<option value='{$post_status}'>{$current_post_status}</option>";

  if ($post_status == 'published') {
    echo "<option value='draft'>Draft</option>";
  } else {
    echo "<option value='published'>Published</option>";
  }
 ?>

    </select>
  </div>

  <div class="form-group">
    <label for="post_image">Image</label>
    <img width='100rem' src="../images/user/<?php echo $post_image; ?>" alt="">
    <input type="file" name="post_image">
  </div>

  <div class="form-group">
    <label for="post_tags">Tags</label>
    <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
  </div>

  <div class="form-group">
    <label for="post_content">Content</label>
    <textarea class="form-control" name="post_content" id="" cols="30" rows="10" ><?php echo $post_content; ?></textarea>
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_post" value="Publish Update">
  </div>

</form>
