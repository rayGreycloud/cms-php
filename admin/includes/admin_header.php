
<?php include "./../includes/db.php"; ?>
<?php include "./functions.php"; ?>
<?php ob_start(); ?>
<?php session_start(); ?>

<?php
  if (!is_admin($_SESSION['username'])) {
    header("Location: index.php");
  }
 ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>CMS Admin</title>

  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/loader.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <!-- Charts -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  <!-- jQuery -->
  <script src="js/jquery.js"></script>

<?php include "./../config/tinymce.php"; ?>


</head>

<body>
