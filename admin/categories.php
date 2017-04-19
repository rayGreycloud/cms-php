<?php include "./includes/admin_header.php" ?>

  <div id="wrapper">

    <!-- Navigation -->
<?php include "./includes/admin_navigation.php" ?>

    <div id="page-wrapper">

      <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header">
              Categories
              <small>Admin</small>
            </h1>
            <ol class="breadcrumb">
              <li>
                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
              </li>
              <li class="active">
                <i class="fa fa-file"></i> Blank Page
              </li>
            </ol>
            <div class="col-xs-6">
<?php
// Add category query
if (isset($_POST['submit'])) {
  $cat_title = $_POST['cat_title'];

  if ($cat_title == "" || empty($cat_title)) {
    echo "This field is required!";
  } else {
    $query = "INSERT INTO categories(cat_title) ";
    $query .="VALUE('{$cat_title}') ";

    $create_category_query = mysqli_query($connection, $query);

    if (!$create_category_query) {
      die('QUERY FAILED ' . mysqli_error($connection));
    }
  }
}
?>

              <form action="" method="post">
                <div class="form-group">
                  <label for="cat-title">ADD A NEW CATEGORY</label>
                  <input class="form-control" type="text" name="cat_title" placeholder="category title">
                </div>
                <div class="form-group">
                  <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                </div>
              </form>

              <hr>

              <form action="" method="post">
                <div class="form-group">
                  <label for="cat-title">EDIT CATEGORY</label>

<?php
  // Edit category query
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

                </div>
                <div class="form-group">
                  <input class="btn btn-primary" type="submit" name="submit" value="Update Category">
                </div>
              </form>

            </div> <!-- /add category form-->
            <div class="col-xs-6">

<?php
  // Select all categories query
  $query = "SELECT * FROM categories";
  $select_categories = mysqli_query($connection, $query);

?>

              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Category Title</th>
                  </tr>
                </thead>
                <tbody>

<?php

while($row = mysqli_fetch_assoc($select_categories)) {
  $cat_id = $row['cat_id'];
  $cat_title = $row['cat_title'];

  echo "<tr>";
  echo "<td>{$cat_id}</td>";
  echo "<td>{$cat_title}</td>";
  echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
  echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
  echo "</tr>";
}
// Delete query
if(isset($_GET['delete'])) {
  $cat_id_to_delete = $_GET['delete'];

  $query = "DELETE FROM categories WHERE cat_id = {$cat_id_to_delete} ";
  $delete_category_query = mysqli_query($connection, $query);
  // Refresh page
  header("Location: categories.php");

}

?>

                </tbody>
              </table>
            </div> <!-- /categories-->

          </div> <!-- /.col -->
        </div> <!-- /.row -->
      </div> <!-- /.container-fluid -->
    </div> <!-- /#page-wrapper -->

<?php include "./includes/admin_footer.php" ?>
