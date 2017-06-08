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

function register_user($username, $email, $password) {
  global $connection;

  $error = [
    'registered'=> FALSE,
    'username'=> '',
    'email'=> '',
    'password'=> ''
  ];

  if (empty($username)) {
    $error['username'] = "Username cannot be empty";
  } else if (strlen($username) < 4) {
    $error['username'] = "Username must be at least 4 characters";
  } else if (already_exists('username', $username)) {
    $error['username'] = "That username is not available";
  } else if (empty($email)) {
    $error['email'] = "Email cannot be empty";
  } else if (already_exists('user_email', $email)){
    $error['email'] = "That email has already been used";
  } else if (empty($password)) {
    $error['password'] = "Please choose a password";
  } else {
    // All is good, register user
    $hashed_pwd = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

    $query = "INSERT INTO users (username, user_password, user_email, user_role) ";
    $query .= "VALUES ('{$username}', '{$hashed_pwd}', '{$email}', 'admin') ";
    $register_user_query = mysqli_query($connection, $query);
    confirmQuery($register_user_query);

    $error['registered'] = TRUE;

  }
  // If values still empty, registration successful
  return $error;
}
?>
