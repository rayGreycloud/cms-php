<?php include "./includes/admin_header.php" ?>

  <div id="wrapper">

    <!-- Navigation -->
<?php include "./includes/admin_navigation.php" ?>

    <div id="page-wrapper">

      <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header">
              Posts
              <small>Admin</small>
            </h1>
            <ol class="breadcrumb">
              <li>
                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
              </li>
              <li class="active">
                <i class="fa fa-file"></i> Blank Page
              </li>
            </ol>

            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Author</th>
                  <th>Title</th>
                  <th>Category</th>
                  <th>Status</th>
                  <th>Image</th>
                  <th>Tags</th>
                  <th>Comments</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>10</td>
                  <td>Darth</td>
                  <td>Lighter side of the Dark Side</td>
                  <td>PHP</td>
                  <td>pending</td>
                  <td>imageUrl</td>
                  <td>force, comedy</td>
                  <td>0</td>
                  <td>04/20/2017</td>
                </tr>
              </tbody>
            </table>


          </div> <!-- /.col -->
        </div> <!-- /.row -->
      </div> <!-- /.container-fluid -->
    </div> <!-- /#page-wrapper -->

<?php include "./includes/admin_footer.php" ?>
