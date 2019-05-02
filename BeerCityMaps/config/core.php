<?php
// show error reporting
error_reporting(E_ALL);
 
// start php session
session_start();
 
// set your default time-zone
date_default_timezone_set('America/New_York');
 
// images forlder
$image_dir="http://localhost/images/";

// home page url
$home_url="http://localhost/";

// about page url
$about_url="http://localhost/about.php";

// map page url
$map_url="http://localhost/map.php";

// breweries page url
$list_url="http://localhost/list.php";

// maps api key
$mapsAPI="AIzaSyA1KmJlsO5vJW0qXlKG1isCIKJqFHQ-ysw";

// zipcode api key
$zipcodeAPI="js-kpp9YtK16LkEN4C5ZfuTcXnaZWDdM7cphZUUEZGimrHWQx0a7UhhHu0yCOF12kF5";
 
// page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// set number of records per page
$records_per_page = 5;
 
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;
?>