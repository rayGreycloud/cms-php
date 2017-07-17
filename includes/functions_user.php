<?php

  function authenticate_user($username, $password) {

    global $connection;

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $get_user_query = mysqli_query($connection, $query);

    if(!$get_user_query) {
      die('Query failed' . mysqli_error($connection));
    }

    $user_info = mysqli_fetch_array($get_user_query);

    $hashed_pwd = $user_info['user_password'];
    $user_role = $user_info['user_role'];

    if (password_verify($password, $hashed_pwd)) {
      return $user_role;
    } else {
      return '';
    }
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

  function isLoggedIn() {
    if (isset($_SESSION['user_role'])) {
      return true;
    }
    return false;
  }

  function checkIfUserisLoggedInAndRedirect($redirectLocation=null) {
    if (isLoggedIn()) {
      redirect($redirectLocation);
    }
  }

  function is_admin($username) {
    global $connection;

    $query = "SELECT user_role FROM users WHERE username = '$username'";

    $user_status_query = mysqli_query($connection, $query);
    confirmQuery($user_status_query);

    $row = mysqli_fetch_array($user_status_query);

    if ($row['user_role'] == 'admin') {
      return true;
    } else {
      return false;
    }
  }  
?>
