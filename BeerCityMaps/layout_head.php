<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- set the page title, for seo purposes too -->
  <title><?php echo isset($page_title) ? strip_tags($page_title) : "BeerCityMaps"; ?></title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen" />
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  
  <!-- Bootstrap JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- custom CSS -->
  <link href="<?php echo $home_url . "libs/css/customer.css" ?>" rel="stylesheet" />
    <script src="https://www.google.com/recaptcha/api.js?render=6LczOKEUAAAAAMefSZJrue4aReXEt6TdB9-VaUOb"></script>
  <script>
  grecaptcha.ready(function() {
      grecaptcha.execute('reCAPTCHA_site_key', {action: 'homepage'}).then(function(token) {
         ...
      });
  });
  </script>
  <!-- Custom Functions -->
  <script type="text/javascript" src="<?php echo $home_url . "libs/js/bcmFunctions.js";?>"></script>
</head>
<body>
  <!-- include the navigation bar -->
  <?php include_once 'navigation.php'; ?>
  <!-- container -->
