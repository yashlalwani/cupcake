<?php
// Database connection
require_once('/structures/dbconnect.php'); 
?>

<?php

if(isset($_GET['datacode']) && ($_GET['email'])) {

// Fetching user input.
$datacode = mysqli_real_escape_string($conn, $_GET['datacode']);
$email = mysqli_real_escape_string($conn, $_GET['email']);

// Query passed wether it exists or no.
$master_query = mysqli_query($conn, "SELECT * FROM `resetpwd` WHERE `datacode` = '$datacode' AND `email` = '$email'");

// Condition passed if the result is equal to 1.
if(mysqli_num_rows($master_query) == 1) {
     
     // Script to change the password when the password change token and email is matched.
     if (isset($_POST['token-submit'])) {
     	  $password = mysqli_real_escape_string($conn, md5($_POST['password-token']));
     	  $re_password = mysqli_real_escape_string($conn, md5($_POST['re-password-token']));
            
            // Condition if the above variable values are equal.
     	    if ($password==$re_password) {
                   // Query passed to update or change the user password to the new desired password. 
     	    	   $update_master_query = mysqli_query($conn, "UPDATE `users` SET `password` = '$re_password' WHERE `email` = '$email'");

     	    	   if ($update_master_query==TRUE) {
                       // If the above passed query is true.
     	    	   	   echo '<div class="success-token">Password Changed Successfully</div>';
                       header('Location: login');
                       $delete_entry = mysqli_query($conn, "DELETE FROM `resetpwd` WHERE `email` = '$email'");
     	    	   }

     	    else {
                  // If the above variable values are not equal.
     	    	  echo '<div class="failure-token">Password Does not Match</div>';
     	    }	   
     	    }
     }

     include('/UI/passwordchange-ui.html');
}
else {
    header('Location: /');
}
}
?>