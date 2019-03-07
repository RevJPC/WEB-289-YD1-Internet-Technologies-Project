<!DOCTYPE html>
<html>
<?php
include 'header.php';
session_start();
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
?>
<div class="container">
    <?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>
    <div class="regisFrm">
        <h2>Create a New Account</h2>
        <form action="userAccount.php" method="post">
            <input type="text" name="first_name" placeholder="First Name" required="">
            <input type="text" name="last_name" placeholder="Last Name" required="">
            <input type="email" name="email" placeholder="Email" required="">
            <input type="text" name="phone" placeholder="Phone Number" required="">
            <input type="text" id="datepicker" name="birthday" placeholder="Birthday" required="">
            <input type="password" name="password" placeholder="Password" required="">
            <input type="password" name="confirm_password" placeholder="Confirm Password" required="">
            <div class="send-button">
            <input type="submit" name="signupSubmit" value="Create Account">
            </div>
            <p>Already have an account? <a href="index.php">Login</a></p>
        </form>
    </div>
</div>
<?php include 'footer.php'; ?>;
</html>