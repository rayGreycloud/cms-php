<?php
  if (isset($_POST['create_post'])) {
    echo "Success!";
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
    <label for="category_id">Category</label>
    <input type="text" class="form-control" name="category_id">
  </div>

  <div class="form-group">
    <label for="post_status">Status</label>
    <input type="text" class="form-control" name="post_status">
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
