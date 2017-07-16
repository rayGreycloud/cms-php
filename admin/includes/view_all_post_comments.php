
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

if (isset($_GET['p_id'])) {

  $comments_post_id = escape($_GET['p_id']);

  $query = "SELECT * FROM comments WHERE comment_post_id = $comments_post_id ";
  $select_comments = mysqli_query($connection, $query);

  while ($row = mysqli_fetch_assoc($select_comments)) {
    $comment_id = $row['comment_id'];
    $comment_post_id = $row['comment_post_id'];
    $comment_author = $row['comment_author'];
    $comment_email = $row['comment_email'];
    $comment_content = substr($row['comment_content'],0,20);
    $comment_status = $row['comment_status'];
    $comment_date = $row['comment_date'];

    echo "<tr>";
    echo "<td>$comment_id</td>";
    echo "<td>$comment_author</td>";
    echo "<td>$comment_email</td>";
    echo "<td>$comment_content</td>";

    $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
    $select_post_id_query = mysqli_query($connection, $query);
    confirmQuery($select_post_id_query);

    while ($row = mysqli_fetch_assoc($select_post_id_query)) {
      $comment_post_title = $row['post_title'];
        echo "<td><a href='../post.php?p_id=$comment_post_id'> $comment_post_title</a></td>";
    }

    echo "<td>$comment_date</td>";
    echo "<td>$comment_status</td>";

    echo "<td><a href='comments.php?approve=$comment_id'>approve</a></td>";
    echo "<td><a href='comments.php?reject={$comment_id}'>reject</a></td>";
    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this comment?') \" href='comments.php?delete={$comment_id}'>delete</a></td>";
    echo "</tr>";

  }
}

?>

              </tbody>
            </table>

<?php

if (isset($_GET['approve'])) {

  $comment_id_to_approve = escape($_GET['approve']);

  $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $comment_id_to_approve ";

  $approve_comment_query = mysqli_query($connection, $query);

  redirect("comments.php");

}
if (isset($_GET['reject'])) {

  $comment_id_to_reject = escape($_GET['reject']);

  $query = "UPDATE comments SET comment_status = 'rejected' WHERE comment_id = $comment_id_to_reject ";

  $reject_comment_query = mysqli_query($connection, $query);

  redirect("comments.php");

}

if (isset($_GET['delete'])) {

  $comment_id_to_delete = escape($_GET['delete']);

  $query = "DELETE FROM comments WHERE comment_id = {$comment_id_to_delete} ";
  $delete_comment_query = mysqli_query($connection, $query);

  redirect("comments.php?source=post_comments&p_id=" . escape($_GET['p_id']) . "");

}

?>
