<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo isset($page_title) ? strip_tags($page_title) : ""; ?></title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen">

  <!-- Bootstrap JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- custom CSS -->
  <link href="<?php echo $home_url . "libs/css/customer.css" ?>" rel="stylesheet">
 
  <!-- Custom Functions -->
  <script type="text/javascript" src="<?php echo $home_url . "libs/js/bcmFunctions.js";?>"></script>
</head>
<body>
    <?php
    // include top navigation bar
    include_once "navigation.php";
    ?>
 
    <!-- container -->
    <div class="container">
