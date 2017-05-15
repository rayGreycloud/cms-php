<?php

include("delete_modal.php");

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

        $query = "DELETE FROM comments WHERE comment_post_id = {$checkedPost_Id} ";
        $delete_comments_query = mysqli_query($connection, $query);
        confirmQuery($delete_comments_query);
        break;

      case 'clone':
        $query = "SELECT * FROM posts WHERE post_id={$checkedPost_Id} ";
        $post_to_clone_query = mysqli_query($connection, $query);
        confirmQuery($post_to_clone_query);

        while ($row = mysqli_fetch_array($post_to_clone_query)) {
          $post_author = $row['post_author'];
          $post_title = $row['post_title'];
          $post_category_id = $row['post_category_id'];
          $post_status = $row['post_status'];
          $post_image = $row['post_image'];
          $post_tags = $row['post_tags'];
          $post_comment_count = 0;
        }

        $query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
        $query .= "VALUES ('{$post_category_id}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_comment_count}', '{$post_status}') ";
        $clone_post_query = mysqli_query($connection, $query);
        confirmQuery($clone_post_query);
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
                  <option value="clone">Clone</option>
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
                  <th>Views</th>
                  <th>Comments</th>
                  <th>Date</th>
                  <th>View</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>

<?php

  $query = "SELECT * FROM posts ORDER BY post_id DESC";
  $select_posts = mysqli_query($connection, $query);
  confirmQuery($select_posts);

  while($row = mysqli_fetch_assoc($select_posts)) {
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_views_count = $row['post_views_count'];
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
    confirmQuery($current_cat_query);

    while($row = mysqli_fetch_assoc($current_cat_query)) {
      $post_category_title = $row['cat_title'];

    }
    echo "<td>$post_category_title</td>";
    echo "<td>$post_status</td>";
    echo "<td><img width='100rem' src='../images/user/$post_image'></td>";
    echo "<td>$post_tags</td>";
    echo "<td><a href='posts.php?reset={$post_id}'>$post_views_count</a></td>";

    $query = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
    $get_post_comments = mysqli_query($connection, $query);
    $post_comment_count = mysqli_num_rows($get_post_comments);
    $row = mysqli_fetch_array($get_post_comments);

    echo "<td><a href='comments.php?source=post_comments&p_id={$post_id}'>$post_comment_count</a></td>";
    echo "<td>$post_date</td>";
    echo "<td><a href='./../post.php?p_id={$post_id}'>View</a></td>";
    echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this post: {$post_title}?') \" href='posts.php?delete={$post_id}'>Delete</a></td>";
    echo "</tr>";

  }
?>

              </tbody>
            </table>
          </form>
<?php

if (isset($_GET['reset'])) {

  $post_id_to_reset = $_GET['reset'];

  $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = {$post_id_to_reset} ";
  $reset_views_count_query = mysqli_query($connection, $query);
  confirmQuery($reset_views_count_query);

  header("Location: posts.php");

}

if (isset($_GET['delete'])) {

  $post_id_to_delete = $_GET['delete'];

  $query = "DELETE FROM posts WHERE post_id = {$post_id_to_delete} ";
  $delete_post_query = mysqli_query($connection, $query);
  confirmQuery($delete_post_query);

  $query = "DELETE FROM comments WHERE comment_post_id = {$post_id_to_delete} ";
  $delete_comments_query = mysqli_query($connection, $query);
  confirmQuery($delete_comments_query);

  header("Location: posts.php");

}

?>
