<?php include "./includes/db.php"; ?>
<?php include "./includes/header.php"; ?>

<!-- Navigation -->
<?php include "./includes/navigation.php"; ?>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">

<?php

if (isset($_GET['category'])) {
  $post_category_id = escape($_GET['category']);

  $query = "SELECT cat_id, cat_title FROM categories WHERE cat_id = $post_category_id";
  $cat_title_query = mysqli_query($connection, $query);
  confirmQuery($cat_title_query);

  while ($row = mysqli_fetch_array($cat_title_query)) {
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];
  }

  echo "<h1 class='page-header'>Posts <small>Category: {$cat_title}</small></h1>";


  $query = "SELECT post_id, post_title, post_author, post_date, post_image, post_content ";
  $query .= "FROM posts WHERE post_category_id = ? AND post_status = ?";
  $published = 'published';
  $stmt = mysqli_prepare($connection, $query);

  mysqli_stmt_bind_param($stmt, "is", $post_category_id, $published);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);
  mysqli_stmt_store_result($stmt);

  if (mysqli_stmt_num_rows($stmt) == 0) {

    echo "<h3 class='text-center bg-primary'>No posts available in category</h3>";
  }

  while(mysqli_stmt_fetch($stmt)):

?>

        <!-- Blog Post Template -->
        <h2>
          <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
        </h2>
        <p class="lead">
          by <a href="index.php"><?php echo $post_author ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
        <hr>
        <img class="img-responsive" src="./images/user/<?php echo $post_image ?>" alt="">
        <hr>
        <p><?php echo $post_content ?></p>
        <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

        <hr>

<?php
    endwhile;
    mysqli_stmt_close($stmt);
}
 ?>

        <!-- Pager -->
        <ul class="pager">
            <li class="previous">
                <a href="#">&larr; Older</a>
            </li>
            <li class="next">
                <a href="#">Newer &rarr;</a>
            </li>
        </ul>

      </div>

      <!-- Blog Sidebar Widgets Column -->
<?php include "./includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->
    <hr>

<?php include "./includes/footer.php"; ?>
