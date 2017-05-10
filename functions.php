<?php

function confirmQuery($result) {
  global $connection;

  if (!$result) {
    return die('QUERY FAILED ' . mysqli_error($connection));
  }

  return $result;
}

function escapeString($connection, $string) {
  global $connection;

  return mysqli_real_escape_string($connection, $string);
}

?>
