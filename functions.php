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


function username_exists($username) {
  global $connection;

  $query = "SELECT username FROM users WHERE username = '$username'";
  $result = mysqli_query($connection, $query);
  confirmQuery($result);

  if (mysqli_num_rows($result) == 0) {
    return false;
  } else {
    return true;
  }
}

function email_exists($email) {
  global $connection;

  $query = "SELECT user_email FROM users WHERE user_email = '$email'";
  $result = mysqli_query($connection, $query);
  confirmQuery($result);

  if (mysqli_num_rows($result) == 0) {
    return false;
  } else {
    return true;
  }
}

?>
