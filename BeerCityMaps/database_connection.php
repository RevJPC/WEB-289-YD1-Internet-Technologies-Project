<?php
$servername = "bvx.wtr.mybluehost.me";
$username = "bvxwtrmy_bcmUser";
$password = 'shitty';
$db = "bvxwtrmy_bcm_0.1";

// Connect to database
$conn = new mysqli($servername, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// Query database
$sql = "SELECT testField FROM testtable";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo $row['testField']."</br>";
  } 
} else {
    echo "No results";
  }
// Close connection
$conn->close(); 
?> 