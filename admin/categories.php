<?php
include "./includes/admin_header.php";
include "./includes/modal_delete.php";
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
              Categories
              <small> <?php echo $_SESSION['username']; ?></small>
            </h1>

            <div class="col-xs-6">

<?php insert_categories(); ?>

              <form action="" method="post" class="add-category__form">
                <div class="form-group">
                  <label for="cat-title">ADD A NEW CATEGORY</label>
                  <input class="form-control" type="text" name="cat_title" placeholder="category title">
                </div>
                <div class="form-group">
                  <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                </div>
              </form>

              <hr>

<?php selectCategoryToEdit() ?>

            </div> <!-- /add category form-->
            <div class="col-xs-6">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Category Title</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>

<?php findAllCategories() ?>
<?php deleteCategory() ?>
<script>

  $(document).ready(function() {
    $('.delete-cat__link').on('click', function() {

      var cat_id = this.dataset.catId;
      var url_delete_cat = `categories.php?delete=${cat_id} `;

      $('.modal_delete_link').attr('href', url_delete_cat);

      $('#modalDelete').modal('show');
    });
  });

</script>

                </tbody>
              </table>
            </div> <!-- /categories-->

          </div> <!-- /.col -->
        </div> <!-- /.row -->
      </div> <!-- /.container-fluid -->
    </div> <!-- /#page-wrapper -->

<?php include "./includes/admin_footer.php" ?>
