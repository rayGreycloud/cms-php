
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Username</th>
                  <th>Firstname</th>
                  <th>Lastname</th>
                  <th>Email</th>
                  <th>Image</th>
                  <th>Role</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
<?php

  $query = "SELECT * FROM users";
  $select_users = mysqli_query($connection, $query);

  while($row = mysqli_fetch_assoc($select_users)) {
    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];

    echo "<tr>";
    echo "<td>$user_id</td>";
    echo "<td>$username</td>";
    echo "<td>$user_firstname</td>";
    echo "<td>$user_lastname</td>";
    echo "<td>$user_email</td>";
    echo "<td>$user_image</td>";
    echo "<td>$user_role</td>";

    echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
    echo "<tr>";

  }
?>

              </tbody>
            </table>

<?php

  if (isset($_GET['delete'])) {

    $user_id_to_delete = $_GET['delete'];

    $query = "DELETE FROM users WHERE user_id = {$user_id_to_delete} ";
    $delete_user_query = mysqli_query($connection, $query);

    header("Location: users.php");

  }

?>
