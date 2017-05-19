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
      $query = "INSERT INTO categories(cat_title) ";
      $query .="VALUE('{$cat_title}') ";

      $create_category_query = mysqli_query($connection, $query);

      confirmQuery($create_category_query);
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

  mysqli_stmt_fetch($stmt);

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

    $query = "DELETE FROM categories WHERE cat_id = {$cat_id_to_delete} ";
    $delete_category_query = mysqli_query($connection, $query);
    confirmQuery($delete_category_query);

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

  $query = "SELECT * FROM " . $table;
  $select_all_records = mysqli_query($connection, $query);
  confirmQuery($select_all_records);

  return mysqli_num_rows($select_all_records);
}

function activityRecordsCount($table, $field, $value) {
  global $connection;

  $query = "SELECT * FROM " . $table . " WHERE " . $field . " = '" . $value . "'";

  $activity_records = mysqli_query($connection, $query);
  confirmQuery($activity_records);

  return mysqli_num_rows($activity_records);
}

 ?>
