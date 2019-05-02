<?php
// core configuration
include_once "config/core.php";
 
// set page title
$page_title = "Login";
 
// include login checker
$require_login=false;
include_once "login_checker.php";
 
// default to false
$access_denied=false;
 
// if the login form was submitted
if($_POST){
    // include classes
    include_once "config/database.php";
    include_once "objects/user.php";
     
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
     
    // initialize objects
    $user = new User($db);
     
    // set user email to detect if it already exists
    $user->email=$_POST['email'];
    
    // check if email exists, also get user details using this emailExists() method
    $email_exists = $user->emailExists();
     
    // validate login
    if ($email_exists && password_verify($_POST['password'], $user->password) && $user->status==1){
     
        // if it is, set the session value to true
        $_SESSION['logged_in'] = true;
        $_SESSION['email'] = $user->email;
        $_SESSION['access_level'] = $user->access_level;
        $_SESSION['firstname'] = htmlspecialchars($user->firstname, ENT_QUOTES, 'UTF-8');
     
        // if access level is 'Admin', redirect to admin section
        if($user->access_level=='Admin'){
            header("Location: {$home_url}admin/index.php?action=login_success");
        }
     
        // else, redirect only to 'Customer' section
        else{
            header("Location: {$home_url}index.php?action=login_success");
        }
    }else{
        $access_denied=true;
    }
}
 
// include page header HTML
include_once "layout_head.php";
 
echo "<div class='col-sm-6 col-md-4 col-md-offset-4'>";
 
    // get 'action' value in url parameter to display corresponding prompt messages
$action=isset($_GET['action']) ? $_GET['action'] : "";
 
// tell the user he is not yet logged in
if($action =='not_yet_logged_in'){
    echo "<div class='alert alert-danger margin-top-40' role='alert'>Please login.</div>";
}
 
// tell the user to login
else if($action=='please_login'){
    echo "<div class='alert alert-info'>Welcome to BeerCityMaps!
    <div>Please login to access that page.</strong>
    </div></div>";
}
 
// tell the user email is verified
else if($action=='email_verified'){
    echo "<div class='alert alert-success'>
        <strong>Your email address has been validated.</strong>
    </div>";
}
 
// tell the user if access denied
if (empty($_POST['email'])){$email_exists=0;}

if ($email_exists) {
 echo "<div class='alert alert-danger margin-top-40' role='alert'>$user->firstname}.  Your password is incorrect.</div>";
}elseif ($access_denied){
    echo "<div class='alert alert-danger margin-top-40' role='alert'>Access Denied.<br><br>Your username or password maybe incorrect</div>";
}

    // actual HTML login form
    echo "<div class='account-wall'>
         <div id='my-tab-content' class='tab-content'>
            <div class='tab-pane active' id='login'>
                <img class='profile-img' src='images/bcm-dropplet.jpg'>
                <form class='form-signin' action='login.php' method='post'>
                  <input type='email' name='email' class='form-control' placeholder='Email' value='".(($email_exists)? $_POST['email'] : '' )."' required autofocus>
                  <input type='password' name='password' class='form-control' placeholder='Password' required>
                  <input type='submit' class='btn btn-lg btn-primary btn-block' value='Log In'>
                    <div class='margin-1em-zero text-align-center'><a href='{$home_url}forgot_password.php'>Forgot password?</a></div>
                </form>
              </div>
            </div>
          </div>
          </div>";
// footer HTML and JavaScript codes
include_once 'layout_foot.php';
?>