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
  $post_to_show_id = escape($_GET['p_id']);

  $query = "UPDATE posts SET post_views_count = post_views_count + 1 ";
  $query .= "WHERE post_id = $post_to_show_id ";
  $increment_views_count_query = mysqli_query($connection, $query);

  confirmQuery($increment_views_count_query);

  $query = "SELECT * FROM posts WHERE post_id = $post_to_show_id ";
  $select_post_query = mysqli_query($connection, $query);
  confirmQuery($select_post_query);

  while ($row = mysqli_fetch_assoc($select_post_query)) {

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
        <img class="img-responsive" src="./images/user/<?php echo $post_image ?>" alt="">
        <hr>
        <p><?php echo $post_content ?></p>

        <hr>

<?php
  }

} else {
  header("Location: index.php");
}
 ?>

<!-- Blog Comments -->
<!-- Posted Comments -->
<?php
$comment_post_id = escape($_GET['p_id']);
$query = "SELECT * FROM comments WHERE comment_post_id = $comment_post_id ";
$query .= "AND comment_status = 'approved' ";
$query .= "ORDER BY comment_id DESC ";
$select_comment_query = mysqli_query($connection, $query);
confirmQuery($select_comment_query);

while ($row = mysqli_fetch_array($select_comment_query)) {
  $comment_date = $row['comment_date'];
  $comment_content = $row['comment_content'];
  $comment_author = $row['comment_author'];
?>

<!-- Comment template -->
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

<hr>
<?php } ?>


<!-- Comment form -->
<?php

if (isset($_POST['create_comment'])) {

  $comment_post_id = escape($_GET['p_id']);
  $comment_author = escape($_POST['comment_author']);
  $comment_email = escape($_POST['comment_email']);
  $comment_status = "pending";
  $comment_content = escape($_POST['comment_content']);

  if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {

    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_status, comment_content, comment_date) ";

    $query .= "VALUES ('{$comment_post_id}', '{$comment_author}', '{$comment_email}', '${comment_status}', '{$comment_content}', now()) ";
    $create_comment_query = mysqli_query($connection, $query);

    confirmQuery($create_comment_query);
/*    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
    $query .= "WHERE post_id = $comment_post_id ";
    $increment_comment_count_query = mysqli_query($connection, $query);
    confirmQuery($increment_comment_count_query);
*/
  } else {
    echo "<script>alert('All fields are required')</script>";
  }
}
?>

<div class="well">
  <h4>Leave a Comment:</h4>
  <form action="" method="POST" role="form">

    <div class="form-group">
      <label for="author">Author</label>
      <input class="form-control" type="text" name="comment_author"></input>
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input class="form-control" type="email" name="comment_email"></input>
    </div>

    <div class="form-group">
      <label for="comment">Comment</label>
      <textarea class="form-control" rows="3" name="comment_content"></textarea>
    </div>

    <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
  </form>
</div>


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
