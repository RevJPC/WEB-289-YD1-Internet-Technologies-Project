<?php
// Change this to your connection info.
$DB_HOST = 'localhost';
$DB_USER = 'bvxwtrmy_bcmUser';
$DB_PASS = 'shitty';
$DB_NAME = 'bvxwtrmy_bcm_0.1';
// Try and connect using the info above.
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($mysqli->connect_errno) {
  // If there is an error with the connection, stop the script and display the error.
  die ('Failed to connect to MySQL: ' . $mysqli->connect_errno);
}
// First we check if the email and code exists...
if (isset($_GET['email'], $_GET['code'])) {
  if ($stmt = $mysqli->prepare('SELECT * FROM users WHERE email = ? AND activation_code = ? AND activation_code != 0')) {
    $stmt->bind_param('ss', $_GET['email'], $_GET['code']);
    $stmt->execute(); 
    // Store the result so we can check if the account exists in the database.
    $stmt->store_result(); 
    if ($stmt->num_rows > 0) {
      // Account exists with the requested email and code.
      if ($stmt = $mysqli->prepare('UPDATE accounts SET activation_code = ? WHERE email = ?')) {
        // Set the new activation code to 'activated', this is how we can check if the user has activated their account.
        $newcode = 'activated';
        $stmt->bind_param('ss', $newcode, $_GET['email']);
        $stmt->execute();
        echo 'Your account is now activated, you can now login!<br><a href="index.html">Login</a>';
      }
    } else {
      echo 'The account is already activated or doesn\'t exist!';
    }
  }
}
?>