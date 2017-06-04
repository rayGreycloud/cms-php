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
  
?>
