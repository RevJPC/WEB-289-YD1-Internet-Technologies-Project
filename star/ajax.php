<?php
require_once 'config.php';

    if($_POST['act'] == 'rate'){
    	$ip = $_SERVER["REMOTE_ADDR"];
    	$therate = $_POST['rate'];
    	$thepost = $_POST['post_id'];

    	$query = mysql_query("SELECT * FROM star where ip= '$ip'  "); 
    	while($data = mysql_fetch_assoc($query)){
    		$rate_db[] = $data;
    	}

    	if(@count($rate_db) == 0 ){
    		mysql_query("INSERT INTO star (id_post, ip, rate)VALUES('$thepost', '$ip', '$therate')");
    	}else{
    		mysql_query("UPDATE star SET rate= '$therate' WHERE ip = '$ip'");
    	}
    } 
?>