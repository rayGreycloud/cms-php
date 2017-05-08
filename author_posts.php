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
    $selected_post_id = $_GET['p_id'];
    $selected_author = $_GET['author'];
  }

  $query = "SELECT * FROM posts WHERE post_author = '{$selected_author}' ";
  $select_author_query = mysqli_query($connection, $query);

  while ($row = mysqli_fetch_assoc($select_author_query)) {

    $post_id = $row['post_id'];
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_date = $row['post_date'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];

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
        <img class="img-responsive" src="./images/<?php echo $post_image ?>" alt="">
        <hr>
        <p><?php echo $post_content ?></p>

        <hr>

<?php } ?>

<!-- Posted Comments -->
<?php
$comment_post_id = $_GET['p_id'];
$query = "SELECT * FROM comments WHERE comment_post_id = $comment_post_id ";
$query .= "AND comment_status = 'approved' ";
$query .= "ORDER BY comment_id DESC ";
$select_comment_query = mysqli_query($connection, $query);

if (!$select_comment_query) {
  die('Query Failed' . mysqli_error($connection));
}

while ($row = mysqli_fetch_array($select_comment_query)) {
  $comment_date = $row['comment_date'];
  $comment_content = $row['comment_content'];
  $comment_author = $row['comment_author'];

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

<?php } ?>

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
