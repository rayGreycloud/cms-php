<?php include "./includes/admin_header.php" ?>
<!-- usersOnlineCount() *omitted* see comments in admin/functions.php -->

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

  $post_count = allRecordsCount('posts');

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

  $comment_count = allRecordsCount('comments');

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

  $user_count = allRecordsCount('users');

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

  $category_count = allRecordsCount('categories');

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

  $draft_post_count = activityRecordsCount('posts', 'draft');

  $published_post_count = activityRecordsCount('posts', 'published');

  $approved_comment_count = activityRecordsCount('comments', 'approved');

  $pending_comment_count = activityRecordsCount('comments', 'pending');

  $admin_count = activityRecordsCount('users', 'admin');

  $subscriber_count = activityRecordsCount('users', 'subscriber');

?>

        <div class="row">

<script type="text/javascript">

  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Activity', 'Number'],

  <?php
  $element_text = array('All Posts', 'Active Posts', 'Draft Posts', 'All Comments', 'Approved', 'Pending', 'All Users', 'Admins', 'Subscribers', 'Categories');

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
