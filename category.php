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
  $query = "SELECT * FROM posts WHERE post_category_id = $post_category_id AND post_status = 'published' ";
  $posts_count_query = mysqli_query($connection, $query);
  confirmQuery($posts_count_query);
  $posts_count = mysqli_num_rows($posts_count_query);
  $page_count = ceil($posts_count / 5);

  if ($posts_count == 0) {
    echo "<h3 class='text-center bg-primary'>No posts found.</h3>";
  } else {

  $query = "SELECT post_id, post_title, post_author, post_date, post_image, post_content ";
  $query .= "FROM posts WHERE post_category_id = ? AND post_status = ? ";
  $query .= "LIMIT ?, 5";
  $published = 'published';
  $stmt = mysqli_prepare($connection, $query);

  mysqli_stmt_bind_param($stmt, "isi", $post_category_id, $published, $top_page);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);
  mysqli_stmt_store_result($stmt);

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
        <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

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

    echo "<li class='{$active_class}'><a href='category.php?category={$post_category_id}&page={$i}'>{$i}</a></li>";
  }
 ?>

        </ul>


      </div>

      <!-- Blog Sidebar Widgets Column -->
<?php include "./includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->
    <hr>

<?php include "./includes/footer.php"; ?>
