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

  if (isset($_GET['p_id'])) {
    $selected_post_id = escape($_GET['p_id']);
    $selected_author = escape($_GET['author']);
  }

  $query = "SELECT post_id, post_title, post_author, post_date, post_image, post_content ";
  $query .= "FROM posts WHERE post_author = ?";

  $stmt = mysqli_prepare($connection, $query);

  mysqli_stmt_bind_param($stmt, "s", $selected_author);

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

        <hr>

<?php
    endwhile;
}
 ?>

<!-- Posted Comments -->
<?php
$comment_post_id = escape($_GET['p_id']);

$query = "SELECT comment_date, comment_content, comment_author, "
$query .= "comment_post_id FROM comments WHERE comment_post_id = ? ";
$query .= "AND comment_status = ? ORDER BY comment_id DESC ";
$approved = 'approved';

$stmt = mysqli_prepare($connection, $query);

mysqli_stmt_bind_param($stmt, "i", $comment_post_id);

mysqli_stmt_execute($stmt);

mysqli_stmt_bind_result($stmt, $comment_date, $comment_content, $comment_author, $comment_post_id);

mysqli_stmt_store_result($stmt);

while(mysqli_stmt_fetch($stmt)):
?>

<!-- Comment -->
<div class="media">
  <a class="pull-left" href="#">
    <img class="media-object" src="http://placehold.it/64x64" alt="">
  </a>
  <div class="media-body">
    <h4 class="media-heading">
      <?php echo $comment_author; ?>
      <small><?php echo $comment_date; ?></small>
    </h4>
    <?php echo $comment_content; ?>
  </div>
</div>

<?php
    endwhile;

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
