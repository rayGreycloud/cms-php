<form action="" method="post">
  <div class="form-group">
    <label for="cat-title">EDIT CATEGORY</label>

<?php

if (isset($_GET['edit'])) {
$cat_id_to_update = $_GET['edit'];

$query = "SELECT * FROM categories WHERE cat_id = {$cat_id_to_update}";
$update_category_query = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($update_category_query)) {
$cat_id = $row['cat_id'];
$cat_title = $row['cat_title'];

}
 ?>

<input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" type="text" class="form-control" name="cat_title">

<?php } ?>

<?php
if(isset($_POST['update_category'])) {
$cat_title_to_update = $_POST['cat_title'];

$query = "UPDATE categories SET cat_title = '{$cat_title_to_update}' WHERE cat_id = {$cat_id_to_update} ";
$update_category_query = mysqli_query($connection, $query);
}
?>

  </div>
  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
  </div>
</form>
