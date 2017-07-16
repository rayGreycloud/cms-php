<?php include("modal_delete.php"); ?>

            <table class="table table-bordered table-hover">
              <div class="col-xs-4 bulkOption__group--pad-bot">
                <a class="btn btn-primary" href="users.php?source=add_user">Add User</a>
              </div>
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Username</th>
                  <th>Firstname</th>
                  <th>Lastname</th>
                  <th>Email</th>
                  <th>Image</th>
                  <th>Role</th>
                  <th class="text-center">Edit</th>
                  <th class="text-center">Delete</th>
                </tr>
              </thead>
              <tbody>
<?php

  $query = "SELECT user_id, username, user_firstname, user_lastname, user_email, user_image, user_role FROM users";

  $stmt = mysqli_prepare($connection, $query);

  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $user_id, $username, $user_firstname, $user_lastname, $user_email, $user_image, $user_role);
  mysqli_stmt_store_result($stmt);

  while(mysqli_stmt_fetch($stmt)):

    if (empty($user_firstname)) {
      $user_firstname = 'n/a';
    }
    if (empty($user_lastname)) {
      $user_lastname = 'n/a';
    }

    echo "<tr>";
    echo "<td>$user_id</td>";
    echo "<td>$username</td>";
    echo "<td>$user_firstname</td>";
    echo "<td>$user_lastname</td>";
    echo "<td>$user_email</td>";

    if (!$user_image) {
      $user_image = "placeholder-user.png";
    }

    echo "<td><img width='50rem' src='../images/user/$user_image'></td>";
    echo "<td>" . ucfirst($user_role) . "</td>";
    echo "<td><a class='btn btn-info' href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";

    echo "<td><a href='javascript:void(0)' data-user-id='{$user_id}' class='delete-user__link btn btn-danger'>Delete</a></td>";
    echo "<tr>";

    endwhile;
    mysqli_stmt_close($stmt);
 ?>
              </tbody>
            </table>

<?php

if (isset($_GET['delete'])) {

  if(isset($_SESSION['user_role'])) {

    if($_SESSION['user_role'] == 'admin') {

      $user_id_to_delete = escape($_GET['delete']);

      $query = "DELETE FROM users WHERE user_id=? ";
      $stmt = mysqli_prepare($connection, $query);
      mysqli_stmt_bind_param($stmt, "i", $user_id_to_delete);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
      redirect("users.php");

    }
  }
}

?>

<script>

  $(document).ready(function() {
    $('.delete-user__link').on('click', function() {

      var user_id = this.dataset.userId;
      var url_delete_user = `users.php?delete=${user_id} `;

      $('.modal_delete_link').attr('href', url_delete_user);

      $('#modalDelete').modal('show');
    });
  });

</script>
