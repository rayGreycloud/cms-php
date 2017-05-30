<?php
ob_start();
// Create array of connection parameters
$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pwd'] = "";
$db['db_name'] = "cms";

// Create constants from array
foreach($db as $key => $value) {
  define(strtoupper($key), $value);
}

// Connect to db
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);

if (!$connection) {
  echo "ERROR: Unable to connect to database.";
}

?>
