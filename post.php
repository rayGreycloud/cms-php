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
    $post_to_show_id = $_GET['p_id'];
  }

  $query = "SELECT * FROM posts WHERE post_id = $post_to_show_id ";
  $select_post_query = mysqli_query($connection, $query);

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
        <img class="img-responsive" src="./images/<?php echo $post_image ?>" alt="">
        <hr>
        <p><?php echo $post_content ?></p>
        

        <hr>

<?php } ?>

<!-- Blog Comments -->

<?php

  if (isset($_POST['create_comment'])) {
    $comment_post_id = $_GET['p_id'];
    $comment_author = $_POST['comment_author'];
    $comment_email = $_POST['comment_email'];
    $comment_status = "pending";
    $comment_content = $_POST['comment_content'];

    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_status, comment_content, comment_date) ";

    $query .= "VALUES ('{$comment_post_id}', '{$comment_author}', '{$comment_email}', '${comment_status}', '{$comment_content}', now()) ";

    $create_comment_query = mysqli_query($connection, $query);

    if(!$create_comment_query) {
      die('Query failed' . mysqli_error($connection));
    };
  }

?>

<!-- Comments Form -->
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

<hr>

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
        <h4 class="media-heading"><?php echo $comment_author; ?>
            <small><?php echo $comment_date; ?></small>
        </h4>
        <?php echo $comment_content; ?>
    </div>
  </div>

<?php } ?>


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
