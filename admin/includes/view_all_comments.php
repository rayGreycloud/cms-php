
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Author</th>
                  <th>Email</th>
                  <th>Content</th>
                  <th>Response to</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Approve</th>
                  <th>Reject</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
<?php

  $query = "SELECT * FROM comments";
  $select_comments = mysqli_query($connection, $query);

  while($row = mysqli_fetch_assoc($select_comments)) {
    $comment_id = $row['comment_id'];
    $comment_post_id = $row['comment_post_id'];
    $comment_author = $row['comment_post_id'];
    $comment_email = $row['comment_email'];
    $comment_content = substr($row['comment_content'],0,20);
    $comment_status = $row['comment_status'];
    $comment_date = $row['comment_date'];

    echo "<tr>";
    echo "<td>$comment_id</td>";
    echo "<td>$comment_author</td>";
    echo "<td>$comment_email</td>";
    echo "<td>$comment_content</td>";

    echo "<td>$comment_post_id</td>";

    echo "<td>$comment_date</td>";
    echo "<td>$comment_status</td>";

    echo "<td><a href='posts.php?source=edit_post&p_id={$comment_id}'>Approve</a></td>";
    echo "<td><a href='posts.php?source=edit_post&p_id={$comment_id}'>Reject</a></td>";
    echo "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";
    echo "</tr>";

  }
?>

              </tbody>
            </table>

<?php

if (isset($_GET['delete'])) {

  $post_id_to_delete = $_GET['delete'];

  $query = "DELETE FROM posts WHERE post_id = {$post_id_to_delete} ";
  $delete_post_query = mysqli_query($connection, $query);

  header("Location: posts.php");

}

?>
