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
              Categories
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
            <div class="col-xs-6">
              <form action="">
                <div class="form-group">
                  <label for="cat-title">ADD A NEW CATEGORY</label>
                  <input class="form-control" type="text" name="cat_title" placeholder="category title">
                </div>
                <div class="form-group">
                  <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                </div>
              </form>
            </div> <!-- /add category form-->
            <div class="col-xs-6">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Category Title</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Javascript</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>ReactJS</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Redux</td>
                  </tr>
                </tbody>
              </table>
            </div> <!-- /categories-->


          </div> <!-- /.col -->
        </div> <!-- /.row -->
      </div> <!-- /.container-fluid -->
    </div> <!-- /#page-wrapper -->

<?php include "./includes/admin_footer.php" ?>
