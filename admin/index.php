<?php include "./includes/admin_header.php" ?>
<?php
/* instructor's code - does not function properly
$session = session_id();
$time = time();
$time_out_in_seconds = 60;
$time_out = $time -$time_out_in_seconds;

$query = "SELECT * FROM users_online WHERE session = '$session'";
$get_users_query = mysqli_query($connection, $query);
$user_count = mysqli_num_rows($get_users_query);

if ($user_count == NULL) {
  $query = "INSERT INTO users_online(session, session_time) ";
  $query .= "VALUES ('$session', '$time')";
  $user_session_query = mysqli_query($connection, $query);
  confirmQuery($user_session_query);

} else {
  $query = "UPDATE users_online SET session_time = '$time' WHERE session = '$session'";
  $user_session_query = mysqli_query($connection, $query);
  confirmQuery($user_session_query);
}

$query = "SELECT * FROM users_online WHERE session_time < '$time_out' ";
$users_online_query = mysqli_query($connection, $query);
confirmQuery($users_online_query);
$users_online_count = mysqli_num_rows($users_online_query);
*/
 ?>

  <div id="wrapper">

    <!-- Navigation -->
<?php include "./includes/admin_navigation.php" ?>

    <div id="page-wrapper">

      <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header">
              Dashboard
              <small> <?php echo $_SESSION['username']; ?></small>
            </h1>
          </div>
        </div>  <!-- /.row -->

        <div class="row">
          <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-3">
                    <i class="fa fa-file-text fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
<?php

  $post_count = recordCount('posts');

  echo "<div class='huge'>{$post_count}</div>"
?>

                    <div>Posts</div>
                  </div>
                </div>
              </div>
              <a href="./posts.php">
                <div class="panel-footer">
                  <span class="pull-left">View Details</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-3">
                    <i class="fa fa-comments fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">

<?php

  $comment_count = recordCount('comments');

  echo "<div class='huge'>{$comment_count}</div>"
?>

                    <div>Comments</div>
                  </div>
                </div>
              </div>
              <a href="./comments.php">
                <div class="panel-footer">
                  <span class="pull-left">View Details</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-3">
                    <i class="fa fa-users fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">

<?php

  $user_count = recordCount('users');

  echo "<div class='huge'>{$user_count}</div>"
?>

                    <div> Users</div>
                  </div>
                </div>
              </div>
              <a href="./users.php">
                <div class="panel-footer">
                  <span class="pull-left">View Details</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-3">
                    <i class="fa fa-list fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">

<?php

  $category_count = recordCount('categories');

  echo "<div class='huge'>{$category_count}</div>"
?>
                    <div>Categories</div>
                  </div>
                </div>
              </div>
              <a href="./categories.php">
                <div class="panel-footer">
                  <span class="pull-left">View Details</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
                </div>
              </a>
            </div>
          </div>
        </div>

<?php

  $query = "SELECT * FROM posts WHERE post_status = 'draft'";
  $select_all_draft_posts = mysqli_query($connection, $query);
  $draft_post_count = mysqli_num_rows($select_all_draft_posts);

  $query = "SELECT * FROM posts WHERE post_status = 'published'";
  $select_all_published_posts = mysqli_query($connection, $query);
  $published_post_count = mysqli_num_rows($select_all_published_posts);

  $query = "SELECT * FROM comments WHERE comment_status = 'approved'";
  $select_all_approved_comments = mysqli_query($connection, $query);
  $approved_comment_count = mysqli_num_rows($select_all_approved_comments);

  $query = "SELECT * FROM comments WHERE comment_status = 'pending'";
  $select_all_pending_comments = mysqli_query($connection, $query);
  $pending_comment_count = mysqli_num_rows($select_all_pending_comments);

  $query = "SELECT * FROM users WHERE user_role = 'admin'";
  $select_all_admins = mysqli_query($connection, $query);
  $admin_count = mysqli_num_rows($select_all_admins);

  $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
  $select_all_subscribers = mysqli_query($connection, $query);
  $subscriber_count = mysqli_num_rows($select_all_subscribers);


?>

        <div class="row">

<script type="text/javascript">

  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Activity', 'Number'],

  <?php
  $element_text = array('All Posts', 'Active Posts', 'Draft Posts', 'All Comments', 'Approved', 'Pending Comments', 'All Users', 'Admins', 'Subscribers', 'Categories');

  $element_count = array($post_count, $published_post_count, $draft_post_count, $comment_count, $approved_comment_count, $pending_comment_count, $user_count, $admin_count, $subscriber_count, $category_count);

  for ($i = 0; $i < sizeof($element_text); $i++) {
    echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
  }

  ?>

    ]);

    var options = {
      chart: {
        title: '',
        subtitle: '',
      }
    };

    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
  }
</script>

          <div id="columnchart_material" style="width: 'auto'; height: 'auto';"></div>

        </div>

      </div>  <!-- /.container-fluid -->

    </div>  <!-- /#page-wrapper -->

<?php include "./includes/admin_footer.php" ?>
