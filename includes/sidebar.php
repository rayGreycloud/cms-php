<div class="col-md-4">

  <!-- Blog Search Well -->
  <div class="well">
      <h4 class="text-center">Blog Search</h4>
      <form action="search.php" method="post">
        <div class="input-group">
          <input name="search" type="text" class="form-control">
          <span class="input-group-btn">
            <button name="submit" class="btn btn-default" type="submit">
              <span class="glyphicon glyphicon-search"></span>
            </button>
          </span>
        </div>
        <!-- /.input-group -->
      </form>
  </div>

  <!-- Login -->
  <div class="well">

<?php if(isset($_SESSION['user_role'])): ?>

      <h4>Signed in as:</h4>
      <h4><strong><?php echo $_SESSION['username']; ?></strong></h4>
      <a href="./includes/logout.php" class="btn btn-primary">Logout</a>
<?php else: ?>
      <h4 class="text-center">
        <a href="./signin.php" class="">Sign in</a> or <a class="" href="./registration.php">Sign up</a>
      </h4>

<?php endif; ?>

  </div>
  <!-- Blog Categories Well -->
  <div class="well">

<?php

$query = "SELECT * FROM categories";
$select_categories_sidebar = mysqli_query($connection, $query);

?>

    <h4 class="text-center">Categories</h4>
    <div class="row">
      <div class="col-lg-12">
        <ul class="list-unstyled">

<?php

while($row = mysqli_fetch_assoc($select_categories_sidebar)) {
  $cat_title = $row['cat_title'];
  $cat_id = $row['cat_id'];

  echo "<li class='text-center'><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
}

?>
        </ul>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
  </div>

  <!-- Side Widget Well -->
<?php include "widget.php"; ?>

</div>
