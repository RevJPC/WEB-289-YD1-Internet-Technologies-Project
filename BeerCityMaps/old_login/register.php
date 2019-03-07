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
// Now we check if the data was submitted, isset will check if the data exists.
if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
  // Could not get the data that should have been sent.
  die ('Please complete the registration form!<br><a href="register.html">Back</a>');
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
  // One or more values are empty...
  die ('Please complete the registration form!<br><a href="register.html">Back</a>');
}
// We need to check if the account with that username exists
  echo "test";
if ($stmt = $mysqli->prepare('SELECT id, password FROM users WHERE username = ?')) {
  // Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
  $stmt->bind_param('s', $_POST['username']);
  $stmt->execute(); 
  $stmt->store_result(); 
  // Store the result so we can check if the account exists in the database.
  if ($stmt->num_rows > 0) {
    // Username already exists
    echo 'Username exists, please choose another!<br><a href="register.html">Back</a>';
  } else {
    // Username doesnt exists, insert new account
    if ($stmt = $mysqli->prepare('INSERT INTO users (username, password, email) VALUES (?, ?, ?)')) {
      // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
      $stmt->execute();
      echo 'You have successfully registered, you can now login!<br><a href="index.html">Login</a>';
    } else {
      echo '1Could not prepare statement!';
    }
  }
  $stmt->close();
} else {
  echo '2Could not prepare statement!';
}
$mysqli->close();
?>
