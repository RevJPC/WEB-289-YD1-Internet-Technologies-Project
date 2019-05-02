<?php
// core configuration
include_once "../config/core.php";
$page_title = "Breweries";

// check if logged in as admin
 
// include classes
include_once '../config/database.php';
include_once '../objects/brewery.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// initialize objects
$user = new Brewery($db);
 
 
// include page header HTML
include_once "layout_head.php";
 
echo "<div class='col-md-12'>";
 
    // read all users from the database
    $stmt = $user->readAll($from_record_num, $records_per_page);
 
    // count retrieved users
    $num = $stmt->rowCount();
 
    // to identify page for paging
    $page_url="breweries.php?";
 
    // include breweries template
    include_once "read_breweries_template.php";
 
echo "</div>";
 
// include page footer HTML
include_once "layout_foot.php";
?>