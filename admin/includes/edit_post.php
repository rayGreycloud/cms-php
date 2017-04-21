<?php
  if (isset($_GET['p_id'])) {

    $post_id_to_edit = $_GET['p_id'];

    $query = "SELECT * FROM posts WHERE post_id = {$post_id_to_edit}";
    $get_post_to_edit_query = mysqli_query($connection, $query);

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
    <select name="" id="">

<?php

  $query1 = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
  $current_cat_query = mysqli_query($connection, $query1);

  while($row = mysqli_fetch_assoc($current_cat_query)) {
    $current_cat_title = $row['cat_title'];
    echo "<option value=''>{$current_cat_title}</option>";
  }

  $query = "SELECT * FROM categories";
  $select_categories_query = mysqli_query($connection, $query);

  while($row = mysqli_fetch_assoc($select_categories_query)) {
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];

    echo "<option value=''>{$cat_title}</option>";
  }
 ?>

    </select>
  </div>

  <div class="form-group">
    <label for="post_status">Status</label>
    <input type="text" class="form-control" name="post_status" value="<?php echo $post_status; ?>">
  </div>

  <div class="form-group">
    <label for="post_image">Image</label>
    <img width='100rem' src="../images/<?php echo $post_image; ?>" alt="">
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
    <input class="btn btn-primary" type="submit" name="create_post" value="Publish Update">
  </div>

</form>
