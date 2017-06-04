<?php ob_start(); ?>
<?php session_start(); ?>

<?php

  session_unset();

  header("Location: ../index.php");

?>
