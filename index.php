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

$query = "SELECT post_id, post_title, post_author, post_date, post_image, post_content ";
$query .= "FROM posts WHERE post_status = ?";
$published = 'published';

$stmt = mysqli_prepare($connection, $query);

mysqli_stmt_bind_param($stmt, "s", $published);

mysqli_stmt_execute($stmt);

mysqli_stmt_bind_result($stmt, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);

mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) == 0) {
    echo "<h2 class='text-center'>No posts found.</h2>";
} else {
  while(mysqli_stmt_fetch($stmt)):

  $post_content = substr($post_content,0,222);

?>

        <!-- Blog Post Template -->
        <h2>
          <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
        </h2>
        <p class="lead">
          by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
        <hr>
        <a href="post.php?p_id=<?php echo $post_id; ?>">
          <img class="img-responsive" src="./images/user/<?php echo $post_image; ?>" alt="">
        </a>
        <hr>
        <p><?php echo $post_content; ?></p>
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

      </div> <!-- /.col-md-8 -->

      <!-- Blog Sidebar Widgets Column -->
<?php include "./includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->
    <hr>

<?php include "./includes/footer.php"; ?>
