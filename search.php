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

if(isset($_POST['submit'])) {
  $search = escape($_POST['search']);

  echo "<h1 class='page-header'>Search <small> {$search}</small></h1>";

  if (isset($_GET['page'])) {
    $page_requested = $_GET['page'];
  } else {
    $page_requested = "";
  }

  if ($page_requested == "" || $page_requested == 1) {
    $top_page = 0;
  } else {
    $top_page = ($page_requested * 5) - 5;
  }
  // Get post count for pagination calculation
  $query = "SELECT * FROM posts WHERE post_tags LIKE '{$search}%' ";
  $posts_count_query = mysqli_query($connection, $query);
  confirmQuery($posts_count_query);
  $posts_count = mysqli_num_rows($posts_count_query);
  $page_count = ceil($posts_count / 5);
  // echo "posts: " . $posts_count;
  // echo "pages: " . $page_count;

  if ($posts_count == 0) {
    echo "<h3 class='text-center bg-primary'>No posts found.</h3>";
  } else {

  $query = "SELECT post_id, post_title, post_author, post_date, post_image, post_content, post_comment_count ";
  $query .= "FROM posts WHERE post_tags LIKE ? ";
  $query .= "LIMIT ?, 5";
  $search_term = $search . '%';
  $stmt = mysqli_prepare($connection, $query);

  mysqli_stmt_bind_param($stmt, "si", $search_term, $top_page);
  mysqli_stmt_execute($stmt);
  confirmQuery($stmt);
  mysqli_stmt_bind_result($stmt, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content, $post_comment_count);
  mysqli_stmt_store_result($stmt);

  while(mysqli_stmt_fetch($stmt)):
  $post_content = substr($post_content,0,222);
  ?>

        <!-- Blog Post Template -->
        <h2>
          <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
        </h2>
        <p class="lead">
          by <a href="author_posts.php?author=<?php echo $post_author; ?>"><?php echo $post_author ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
        <hr>
        <img class="img-responsive" src="./images/user/<?php echo $post_image ?>" alt="">
        <hr>
        <p><?php echo $post_content ?></p>
        <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
        <div class="pull-right"><i class="fa fa-comments fa-2x"></i> <huge><?php echo $post_comment_count ?></huge></div>

        <hr>

<?php
    endwhile;
    mysqli_stmt_close($stmt);
  }
}
 ?>

 <!-- Pager -->
 <ul class="pagination">

<?php
  for ($i = 1; $i <= $page_count; $i++) {
    $active_class = '';

    if ($i == $page_requested) {
    $active_class = 'active';
    }
    // ISSUE: pagination not working because search is post request
    // Not cached and not url based
    // page_count becomes undefined

    // None of the below work:
     
    echo "<li class='{$active_class}'><a href='search.php?search={$search}%&page={$i}'>{$i}</a></li>";

    // echo "<li class='page-item {$active_class}'><form action='search.php' method='post'><input class='page-link' type='submit' value='{$i}' /i></form></li>";

    // echo "<li class='{$active_class}'><a href='search.php?page={$i}'>{$i}</a></li>";
  }
?>

 </ul>

      </div> <!-- /.col-md-8 -->

      <!-- Blog Sidebar Widgets Column -->
<?php include "./includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->
    <hr>

<?php include "./includes/footer.php"; ?>
