<?php
// core configuration
include_once "config/core.php";
$page_title = "List";

// check if logged in as admin
include_once "login_checker.php";
 
// include classes
include_once 'config/database.php';
include_once 'objects/brewery.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// initialize objects
$brewery = new Brewery($db);
 
 
// include page header HTML
include_once "layout_head.php";
 
echo "<div class='col-md-12'>";
 
    // read all breweries from the database
    $stmt = $brewery->readAll($from_record_num, $records_per_page);
 
    // count retrieved breweries
    $num = $stmt->rowCount();
 
    // to identify page for paging
    $page_url="list.php?";
 
    // include breweries template
    include_once "breweries_template.php";
 
echo "</div>";
 
// include page footer HTML
include_once "layout_foot.php";
?>