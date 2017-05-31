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

function register_user($username, $email, $password) {
  global $connection;

  if (username_exists($username)) {
    $message = "That username is not available";
  } else if (email_exists($email)) {
    $message = "That email has already been used";
  } else if (empty($username) || empty($email) || empty($password)) {
    $message = "All fields are required";
  } else {

    $hashed_pwd = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

    $query = "INSERT INTO users (username, user_password, user_email, user_role) ";
    $query .= "VALUES ('{$username}', '{$hashed_pwd}', '{$email}', 'subscriber') ";
    $register_user_query = mysqli_query($connection, $query);
    confirmQuery($register_user_query);

    $message = "Registration successful";
  }
  return $message;
}
?>
