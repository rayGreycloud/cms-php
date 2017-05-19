<?php

function confirmQuery($result) {
  global $connection;

  if (!$result) {
    return die('QUERY FAILED ' . mysqli_error($connection));
  }

  return $result;
}

function escape($string) {
  global $connection;

  return mysqli_real_escape_string($connection, trim($string));
}

function insert_categories() {

  global $connection;

  if (isset($_POST['submit'])) {
    $cat_title = escape($_POST['cat_title']);

    if ($cat_title == "" || empty($cat_title)) {
      echo "This field is required!";
    } else {
      $query = "INSERT INTO categories(cat_title) VALUES (?) ";

      $stmt = mysqli_prepare($connection, $query);

      mysqli_stmt_bind_param($stmt, 's', $cat_title);

      mysqli_stmt_execute($stmt);

    }
  }
}

function findAllCategories() {
  global $connection;

  $query = "SELECT cat_id, cat_title FROM categories ";

  $stmt = mysqli_prepare($connection, $query);

  mysqli_stmt_execute($stmt);

  mysqli_stmt_bind_result($stmt, $cat_id, $cat_title);

  mysqli_stmt_store_result($stmt);

  while(mysqli_stmt_fetch($stmt)):

    echo "<tr>";
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
    echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
    echo "<td><a href='javascript:void(0)' data-cat-id='{$cat_id}' class='delete-cat__link'>Delete</a></td>";
    echo "</tr>";

  endwhile;
}

function deleteCategory() {
  global $connection;

  if (isset($_GET['delete'])) {
    $cat_id_to_delete = escape($_GET['delete']);

    $query = "DELETE FROM categories WHERE cat_id = ? ";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $cat_id_to_delete);
    mysqli_stmt_execute($stmt);

    // $delete_category_query = mysqli_query($connection, $query);
    // confirmQuery($delete_category_query);

    header("Location: categories.php");
  }
}

function selectCategoryToEdit() {
  global $connection;

  if (isset($_GET['edit'])) {
    $cat_id = escape($_GET['edit']);
    include "includes/update_categories.php";
  }
}

function allRecordsCount($table) {
  global $connection;

  switch($table) {
    case 'posts':
      $query = "SELECT * FROM posts ";
      break;
    case 'comments':
      $query = "SELECT * FROM comments ";
      break;
    case 'users':
      $query = "SELECT * FROM users ";
      break;
    case 'categories':
      $query = "SELECT * FROM categories ";
      break;
  }

  $stmt = mysqli_prepare($connection, $query);

  mysqli_stmt_execute($stmt);

  mysqli_stmt_store_result($stmt);

  mysqli_stmt_fetch($stmt);

  return mysqli_stmt_num_rows($stmt);
}

function activityRecordsCount($table, $value) {
  global $connection;

  switch($table) {

    case 'posts':
      $query = "SELECT * FROM posts WHERE post_status = ? ";
      break;
    case 'comments':
      $query = "SELECT * FROM comments WHERE comment_status = ? ";
      break;
    case 'users':
      $query = "SELECT * FROM users WHERE user_role = ? ";
      break;
  }

  $stmt = mysqli_prepare($connection, $query);

  mysqli_stmt_bind_param($stmt, "s", $value);

  mysqli_stmt_execute($stmt);

  mysqli_stmt_store_result($stmt);

  mysqli_stmt_fetch($stmt);

  return mysqli_stmt_num_rows($stmt);
}

 ?>
