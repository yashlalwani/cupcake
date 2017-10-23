<?php 
// Database Connection
require_once('/structures/dbconnect.php'); ?>

<?php

// Fetching latest date from server
$date = date("d-m-y");

if(isset($_POST['token-submit'])) {
	  // Fetching values in variables
      $name = mysqli_real_escape_string($conn, $_POST['name-token']);
      $email = mysqli_real_escape_string($conn, $_POST['email-token']);
      $password = mysqli_real_escape_string($conn, md5($_POST['password-token']));
      
      // Query passed wether account exists or not.
      $check_query = mysqli_query ($conn, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");
      $check_count = mysqli_num_rows($check_query);

      // Condition passed if the count is equal to 1.
      if($check_count==1) {
             echo '<div class="fail-token">Account Already Exists</div>';
      }

      else {

      // If the above condition is not true. User will get signed up.
      $signup_query = mysqli_query($conn, "INSERT INTO `users` (`name`, `email`, `password`, `status`, `creationdate`, `lastlogin`) VALUES ('$name','$email','$password','active','$date','notloggedin')"); 
       
        if ($signup_query==TRUE) {
             echo '<div class="success-token">You Have Signed Up.</div>';
        }
        else {
        	echo 'Server Error';
        }
}
}
?>

<?php include('/UI/signup-form.html'); ?>