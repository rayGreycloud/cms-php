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


function already_exists($field, $value) {
  global $connection;

  $query = "SELECT $field FROM users WHERE $field = '$value'";
  $result = mysqli_query($connection, $query);
  confirmQuery($result);

  if (mysqli_num_rows($result) == 0) {
    return false;
  } else {
    return true;
  }
}

// function email_exists($email) {
//   global $connection;
//
//   $query = "SELECT user_email FROM users WHERE user_email = '$email'";
//   $result = mysqli_query($connection, $query);
//   confirmQuery($result);
//
//   if (mysqli_num_rows($result) == 0) {
//     return false;
//   } else {
//     return true;
//   }
// }

function register_user($username, $email, $password) {
  global $connection;

  if (empty($username) || empty($email) || empty($password)) {
    $message = "All fields are required";
  } else if (already_exists('username', $username)) {
    $message = "That username is not available";
  } else if (strlen($username) < 4) {
    $message = "Username must be at least 4 characters";
  } else if (already_exists('user_email', $email)) {
    $message = "That email has already been used";
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
