<?php
// core configuration
include_once 'config/core.php';
 
// set page title
$page_title = 'Register';
 
// include login checker
include_once 'login_checker.php';
 
// include classes
include_once 'config/database.php';
include_once 'objects/user.php';
include_once 'libs/php/utils.php';
 
// include page header HTML
include_once 'layout_head.php';
 
echo "<div class='col-md-12'>";
 
    // if form was posted
if($_POST){
 
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
 
    // initialize objects
    $user = new User($db);
    $utils = new Utils();
 
    // set user email to detect if it already exists
    $user->email=$_POST['email'];
 
    // check if email already exists
    if($user->emailExists()){
        echo "<div class='alert alert-danger'>";
            echo "The email you specified is already registered. Please try again or <a href='{$home_url}login'>login.</a>";
        echo "</div>";
    }else{
      // set values to object properties
      $user->firstname=$_POST['firstname'];
      $user->lastname=$_POST['lastname'];
      $user->birthday=$_POST['birthday'];
      $user->contact_number=$_POST['contact_number'];
      $user->address=$_POST['address'];
      $user->city=$_POST['city'];
      $user->state=$_POST['state'];
      $user->zipcode=$_POST['zipcode'];
      $user->password=$_POST['password'];
      $user->access_level='Customer';
      $user->status=0;

      // access code for email verification
      $access_code=$utils->getToken();
      $user->access_code=$access_code;
       
// create the user
if($user->create()){
 
    // send confimation email
    $send_to_email=$_POST['email'];
    $body="Hi {$send_to_email}.<br /><br />";
    $body.="Please click the following link to verify your email and login: {$home_url}verify.php/?access_code={$access_code}<br>";
    $subject="Verification Email";
 
    if($utils->sendEmailViaPhpMail($send_to_email, $subject, $body)){
        echo "<div class='alert alert-success'>
            Verification link was sent to your email. Click that link to login.
        </div>";
    }else{
        echo "<div class='alert alert-danger'>
            User was created but unable to send verification email. Please contact admin.
        </div>";
    }
 
    // empty posted values
    $_POST=array();
 
}else{
  echo "<div class='alert alert-danger' role='alert'>Unable to register. Please try again.</div>";
}}}
?>
<!-- REGISTRATION FORM -->
<div class='col-sm-6 col-md-4 col-md-offset-4'>
  <div class='account-wall'><h2>BeerCityMaps Registration!</h2>
    <div id='my-tab-content' class='tab-content'>
      <div class='tab-pane active' id='register'>
      <form action='register.php' method='post' id='register'>
        <table class='table table-responsive'>
          <tr>
            <td class='width-30-percent'>First Name *</td>
            <td><input type='text' name='firstname' class='form-control' placeholder='First' required value="<?php echo isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname'], ENT_QUOTES) : "";  ?>"></td>
          </tr>
          <tr>
            <td>Last Name *</td>
            <td><input type='text' name='lastname' class='form-control' placeholder='Last' required value="<?php echo isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname'], ENT_QUOTES) : "";  ?>"></td>
          </tr>
          <tr>
            <td>Birthday *</td>
            <td><input type='date' name='birthday' id='birthday' max="<?php $d=strtotime("-21 Years"); echo date('Y-m-d', $d) ?>" oninvalid="setCustomValidity('Must be 21 years or older')" class='form-control' required value='' /></td>
          </tr>
          <tr>
            <td>Contact Number</td>
            <td><input type='tel' pattern='[0-9]{10}' oninvalid="setCustomValidity('Please enter in 8285551212 format')" name='contact_number' placeholder='8285551212' class='form-control' value="<?php echo isset($_POST['contact_number']) ? htmlspecialchars($_POST['contact_number'], ENT_QUOTES) : "";  ?>"></td>
          </tr>

          <tr>
            <td>Address</td>
            <td><input type='text' name='address' class='form-control' placeholder='Address' value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address'], ENT_QUOTES) : '';  ?>"></td>
          </tr>
          <!-- CITY STATE ZIP -->
          <tr>
            <td>Zip Code *</td>
            <td><input type="text" name="zipcode" id="zipcode" class="form-control" required value="<?php echo isset($_POST['city']) ? htmlspecialchars($_POST['zipcode'], ENT_QUOTES) : "";  ?>"></td>
          </tr>
          <tr>
            <td>City *</td>
            <td><input type="text" id="city" name="city" class="form-control" tabindex=-1 placeholder="City will automaticlly populate from Zip Code" required value="<?php echo isset($_POST['city']) ? htmlspecialchars($_POST['city'], ENT_QUOTES) : "";  ?>"></td>
          </tr>
          <tr>
            <td>State *</td>
            <td><input type="text" name="state" id="state" class="form-control" tabindex=-1 placeholder="State will automaticlly populate from Zip Code" required value="<?php echo isset($_POST['state']) ? htmlspecialchars($_POST['state'], ENT_QUOTES) : "";  ?>"></td>
            </tr>
            <!-- END CITY STATE ZIP -->
            <tr>
              <td>Email *</td>
              <td><input type='email' name='email' class='form-control' required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES) : "";  ?>"></td>
            </tr>
            <tr>
              <td>Password *</td>
              <td><input type='password' name='password' class='form-control' required id='passwordInput'></td>
            </tr>
            <tr>
              <td></td>
              <td>
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Register</button>
              </td>
            </tr>
          </table>
          </form>
  </div>
</div>
</div>
<?php include_once "layout_foot.php"; ?>