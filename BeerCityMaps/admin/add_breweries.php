<?php
// core configuration
include_once '../config/core.php';
 
// set page title
$page_title = 'Add Breweries';
 
// include login checker
include_once 'login_checker.php';
 
// include classes
include_once '../config/database.php';
include_once '../objects/brewery.php';
include_once '../libs/php/utils.php';
 
// include page header HTML
include_once 'layout_head.php';
 
echo "<div class='col-md-12'>";
 
    // if form was posted
if($_POST){

  //move logo image to folder
  $logo = $_FILES['logo']['name'];
  $tempname = $_FILES['logo']['tmp_name'];
  $file_size = $_FILES['logo']['size'];


move_uploaded_file($_FILES['logo']['tmp_name'], "../images/". $_FILES['logo']['name']);





 
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
 
    // initialize objects
    $brewery = new Brewery($db);

      // set values to object properties
      $brewery->name=$_POST['name'];
      $brewery->link=$_POST['link'];
      $brewery->email=$_POST['email'];
      $brewery->contact_number=$_POST['contact_number'];
      $brewery->address=$_POST['address'];
      $brewery->city=$_POST['city'];
      $brewery->state=$_POST['state'];
      $brewery->zip=$_POST['zip'];
      $brewery->ad_text=$_POST['ad_text'];
      $brewery->description=$_POST['description'];
      $brewery->lat=$_POST['lat'];
      $brewery->lng=$_POST['lng'];
      $brewery->logo=$logo;

      // create brewery
      if($brewery->create())
    // empty posted values
        $_POST=array();
    }
    

?>
<form action='add_breweries.php' method='post' enctype="multipart/form-data" id='register'>
  <table class='table table-responsive'>

    <tr>
      <td class='width-30-percent'>Name</td>
      <td><input type='text' name='name' class='form-control' required value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name'], ENT_QUOTES) : "";  ?>" /></td>
    </tr>
    <tr>
      <td class='width-30-percent'>Link</td>
      <td><input type='text' name='link' class='form-control' required value="<?php echo isset($_POST['link']) ? htmlspecialchars($_POST['link'], ENT_QUOTES) : "";  ?>" /></td>
    </tr>
    <tr>
      <td class='width-30-percent'>Email</td>
      <td><input type='text' name='email' class='form-control' required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES) : "";  ?>" /></td>
    </tr>
    <tr>
      <td class='width-30-percent'>Contact Number</td>
      <td><input type='text' name='contact_number' class='form-control' required value="<?php echo isset($_POST['contact_number']) ? htmlspecialchars($_POST['contact_number'], ENT_QUOTES) : "";  ?>" /></td>
    </tr>
    <tr>
      <td class='width-30-percent'>Address</td>
      <td><input type='text' name='address' class='form-control' required value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address'], ENT_QUOTES) : "";  ?>" /></td>
    </tr>
    <tr>
      <td class='width-30-percent'>City</td>
      <td><input type='text' name='city' class='form-control' required value="<?php echo isset($_POST['city']) ? htmlspecialchars($_POST['city'], ENT_QUOTES) : "";  ?>" /></td>
    </tr>
    <tr>
      <td class='width-30-percent'>State</td>
      <td><input type='text' name='state' class='form-control' required value="<?php echo isset($_POST['state']) ? htmlspecialchars($_POST['state'], ENT_QUOTES) : "";  ?>" /></td>
    </tr>
    <tr>
      <td class='width-30-percent'>Zip</td>
      <td><input type='text' name='zip' class='form-control' required value="<?php echo isset($_POST['zip']) ? htmlspecialchars($_POST['zip'], ENT_QUOTES) : "";  ?>" /></td>
    </tr>
    <tr>
      <td class='width-30-percent'>Ad Text</td>
      <td><input type='text' name='ad_text' class='form-control' required value="<?php echo isset($_POST['ad_text']) ? htmlspecialchars($_POST['ad_text'], ENT_QUOTES) : "";  ?>" /></td>
    </tr>
    <tr>
      <td class='width-30-percent'>Description</td>
      <td><input type='text' name='description' class='form-control' required value="<?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description'], ENT_QUOTES) : "";  ?>" /></td>
    </tr>
    <tr>
      <td class='width-30-percent'>Latitude</td>
      <td><input type='text' name='lat' class='form-control' required value="<?php echo isset($_POST['lat']) ? htmlspecialchars($_POST['lat'], ENT_QUOTES) : "";  ?>" /></td>
    </tr>
    <tr>
      <td class='width-30-percent'>Longitude</td>
      <td><input type='text' name='lng' class='form-control' required value="<?php echo isset($_POST['lng']) ? htmlspecialchars($_POST['lng'], ENT_QUOTES) : "";  ?>" /></td>
    </tr>

    <!-- LOGO UPLOAD -->




<?php





?>

<tr>
  <td class="width-30-percent">Logo</td>
  <td><input type="file" name='logo' class='form-control'></td>
<td></td>
</tr>




    <td>
      <button type="submit" class="btn btn-primary">
      <span class="glyphicon glyphicon-plus"></span> Register</button>
    </td>
    </tr>
  </table>
</form>
<?php
 
echo "</div>";
 
// include page footer HTML
include_once "layout_foot.php";
?>