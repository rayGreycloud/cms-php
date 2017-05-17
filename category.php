<?php include "./includes/db.php"; ?>
<?php include "./includes/header.php"; ?>

<!-- Navigation -->
<?php include "./includes/navigation.php"; ?>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">
        <h1 class="page-header">
          Posts
          <small>Category: All</small>
        </h1>

<?php

if (isset($_GET['category'])) {
  $post_category_id = escape($_GET['category']);

  if ($_SESSION['user_role'] == 'admin') {
    $query = "SELECT post_id, post_title, post_author, post_date, post_image, post_content ";
    $query .= "FROM posts WHERE post_category_id = ?";
    $stmt1 = mysqli_prepare($connection, $query);

  } else {
    $query = "SELECT post_id, post_title, post_author, post_date, post_image, post_content ";
    $query .= "FROM posts WHERE post_category_id = ? AND post_status = ?";
    $published = 'published';
    $stmt2 = mysqli_prepare($connection, $query);
  }

  if (isset($stmt1)) {
    mysqli_stmt_bind_param($stmt1, "i", $post_category_id);

    mysqli_stmt_execute($stmt1);

    mysqli_stmt_bind_result($stmt1, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);

    $stmt = $stmt1;

  } else {
    mysqli_stmt_bind_param($stmt2, "is", $post_category_id, $published);

    mysqli_stmt_execute($stmt2);

    mysqli_stmt_bind_result($stmt2, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);

    $stmt = $stmt2;
  }

  mysqli_stmt_store_result($stmt);

  if (mysqli_stmt_num_rows($stmt) == 0) {

    echo "<h3 class='text-center'>No posts available in that category</h3>";
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
