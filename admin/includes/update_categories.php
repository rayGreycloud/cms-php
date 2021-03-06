<form action="" method="post">
  <div class="form-group">
    <label for="cat-title">EDIT CATEGORY</label>

<?php

  if (isset($_GET['edit'])) {

    $cat_id_to_update = escape($_GET['edit']);

    $query = "SELECT cat_id, cat_title FROM categories WHERE cat_id = ? ";

    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $cat_id_to_update);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $cat_id, $cat_title);
    mysqli_stmt_store_result($stmt);

    while(mysqli_stmt_fetch($stmt)):

 ?>

<input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" type="text" class="form-control" name="cat_title">

<?php
    endwhile;
  }
 ?>

<?php
  if (isset($_POST['update_category'])) {
    $cat_title_to_update = escape($_POST['cat_title']);

    $query = "UPDATE categories SET cat_title = ? WHERE cat_id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "si", $cat_title_to_update, $cat_id_to_update);
    mysqli_stmt_execute($stmt);
    confirmQuery($stmt);

    redirect("categories.php");
  }
?>

  </div>
  <div class="form-group">
    <input class="btn btn-primary cat-update" type="submit" name="update_category" value="Update Category">
  </div>
</form>

<script>

  $(document).ready(function() {
    $('.add-category__form').addClass("form--invisible");

    $('.cat-update').on('click', function() {
      $('.add-category__form').removeClass("form--invisible");
    });
  });
</script>
