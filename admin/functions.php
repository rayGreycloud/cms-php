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
    $cat_title = $_POST['cat_title'];

    if ($cat_title == "" || empty($cat_title)) {
      echo "This field is required!";
    } else {
      $query = "INSERT INTO categories(cat_title) ";
      $query .="VALUE('{$cat_title}') ";

      $create_category_query = mysqli_query($connection, $query);

      if (!$create_category_query) {
        die('QUERY FAILED ' . mysqli_error($connection));
      }
    }
  }
}

function findAllCategories() {
  global $connection;

  $query = "SELECT * FROM categories";
  $select_categories = mysqli_query($connection, $query);

  while($row = mysqli_fetch_assoc($select_categories)) {
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];

    echo "<tr>";
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this category: {$cat_title}?') \" href='categories.php?delete={$cat_id}'>Delete</a></td>";
    echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
    echo "</tr>";
  }
}

function deleteCategory() {
  global $connection;

  if (isset($_GET['delete'])) {
    $cat_id_to_delete = $_GET['delete'];

    $query = "DELETE FROM categories WHERE cat_id = {$cat_id_to_delete} ";
    $delete_category_query = mysqli_query($connection, $query);
    // Refresh page
    header("Location: categories.php");
  }
}

function selectCategoryToEdit() {
  global $connection;

  if (isset($_GET['edit'])) {
    $cat_id = $_GET['edit'];
    include "includes/update_categories.php";
  }
}

?>
