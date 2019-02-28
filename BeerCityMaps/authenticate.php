<?php
session_start();


// Change this to your connection info.
$DB_HOST = 'localhost';
$DB_USER = 'bvxwtrmy_bcmUser';
$DB_PASS = 'shitty';
$DB_NAME = 'bvxwtrmy_bcm_0.1';
// Try and connect using the info above.
$con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ( mysqli_connect_errno() ) {
  // If there is an error with the connection, stop the script and display the error.
  die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// Now we check if the data was submitted, isset will check if the data exists.
if ( !isset($_POST['username'], $_POST['password']) ) {
  // Could not get the data that should have been sent.
  die ('AUsername and/or password does not exist!');
}
// Prepare our SQL 
if ($stmt = $con->prepare('SELECT userid, password FROM users WHERE username = ?')) {
  // Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
  $stmt->bind_param('s', $_POST['username']);
  $stmt->execute(); 
  $stmt->store_result(); 
  // Store the result so we can check if the account exists in the database.
  if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $password);
    $stmt->fetch();      
    // Account exists, now we verify the password.
    if (password_verify($_POST['password'], $password)) {
      // Verification success! User has loggedin!
      $_SESSION['loggedin'] = TRUE;
      $_SESSION['name'] = $_POST['username'];
      $_SESSION['id'] = $id;
      echo 'Welcome ' . $_SESSION['name'] . '!';
    } else {
      echo 'Incorrect username and/or password!';
    }
  } else {
    echo 'Incorrect username and/or password!';
  }
  $stmt->close();
} else {
  echo 'Could not prepare statement!';
}
?>