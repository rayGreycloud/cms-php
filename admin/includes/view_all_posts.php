<?php

  if (isset($_POST['checkBoxArray'])) {

    foreach ($_POST['checkBoxArray'] as $checkedPost_Id) {
      $bulk_options = $_POST['bulk_options'];

      switch($bulk_options) {
        case 'draft':
        case 'published':
          $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkedPost_Id} ";
          $update_to_post_status = mysqli_query($connection, $query);

          confirmQuery($update_to_post_status);
          break;
        case 'delete':
          $query = "DELETE FROM posts WHERE post_id={$checkedPost_Id} ";
          $delete_post_query = mysqli_query($connection, $query);

          confirmQuery($delete_post_query);
          break;

      }
    }

  }


 ?>

          <form action="" method="post" class="form-group">
            <table class="table table-bordered table-hover">

              <div class="col-xs-4 bulkOption__group--pad-bot" id="bulkOptionContainer">
                <select class="form-control" name="bulk_options" id="">
                  <option value="">Select Options</option>
                  <option value="published">Publish</option>
                  <option value="draft">Draft</option>
                  <option value="delete">Delete</option>
                </select>
              </div>
              <div class="col-xs-4 bulkOption__group--pad-bot">
                <input type="submit" name="submit" class="btn btn-success" value="Apply">
                <a class="btn btn-primary" href="./posts.php?source=add_post">Add Post</a>
              </div>

              <thead>
                <tr>
                  <th><input id="selectAllBoxes" type="checkbox"></th>
                  <th>Id</th>
                  <th>Author</th>
                  <th>Title</th>
                  <th>Category</th>
                  <th>Status</th>
                  <th>Image</th>
                  <th>Tags</th>
                  <th>Comments</th>
                  <th>Date</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>

<?php

  $query = "SELECT * FROM posts";
  $select_posts = mysqli_query($connection, $query);

  while($row = mysqli_fetch_assoc($select_posts)) {
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];

    echo "<tr>";
?>
    <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $post_id; ?>"></td>

<?php
    echo "<td>$post_id</td>";
    echo "<td>$post_author</td>";
    echo "<td>$post_title</td>";

    $cat_query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
    $current_cat_query = mysqli_query($connection, $cat_query);

    while($row = mysqli_fetch_assoc($current_cat_query)) {
      $post_category_title = $row['cat_title'];

    }
    echo "<td>$post_category_title</td>";
    echo "<td>$post_status</td>";
    echo "<td><img width='100rem' src='../images/$post_image'></td>";
    echo "<td>$post_tags</td>";
    echo "<td>$post_comment_count</td>";
    echo "<td>$post_date</td>";
    echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
    echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
    echo "</tr>";

  }
?>

              </tbody>
            </table>
          </form>
<?php

if (isset($_GET['delete'])) {

  $post_id_to_delete = $_GET['delete'];

  $query = "DELETE FROM posts WHERE post_id = {$post_id_to_delete} ";
  $delete_post_query = mysqli_query($connection, $query);

  header("Location: posts.php");

}

?>
