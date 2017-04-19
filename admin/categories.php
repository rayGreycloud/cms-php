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
            </div> <!-- /add category form-->
            <div class="col-xs-6">

<?php

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

  echo "<tr><td>{$cat_id}</td><td>{$cat_title}</td></tr>";
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
