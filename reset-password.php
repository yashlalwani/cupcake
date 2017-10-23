<?php
// database connection
require_once('/structures/dbconnect.php');

if (isset($_POST['submit-token'])) {
    // Generating a random string which would be the password reset token
    function generateRandomString($length = 20) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
// fetching the random token into a variable.
$datacode = generateRandomString();

// posting up the value from the email input box
$email = mysqli_real_escape_string($conn, $_POST['email-token']);

// query to check wether email exists or not.
$master_query = mysqli_query($conn, "SELECT * FROM `users` WHERE `email` = '$email'");

// checks wether the count is equal to 1.
if (mysqli_num_rows($master_query) == 1) {

     // fetching up the data in an associative array
	 $fetch_userdata = mysqli_fetch_assoc($master_query);

     // getting the latest status of the user
	 $status = $fetch_userdata['status'];

     // setting up an condition if the status of the user is active
	 if ($status == "active") {
           $data_code_query = mysqli_query($conn, "INSERT INTO `resetpwd` (`datacode`,`email`) VALUES ('$datacode','$email')");
           echo '<div class="success-token">Instructions sent to your email</div>';

           $to = $email;
         $subject = "Find Your Password Change Link";
         
         $message = "<h1 style='margin-bottom: 20px;'>Hello, You have requested for a password change?</h1>";
         $message .= "<b>Reset using this <a href='yourdomain.tld/change-password?datacode=$datacode&email=$email' style='text-decoration:none;color:#2188ff'>link</a></b>
            <h2 style='margin-bottom:20px;'> Cheers </h2>
             <h2> Powered By <a href='https://cupcake.namegrill.com' style='text-decoration:none;color:#2188ff'> Cupcake </a> </h2>
         ";
         
         $header = "From: youremail@yourdomain.tld \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $send_email = mail ($to,$subject,$message,$header);
	 }
	 // setting up another condition if the user status is not active
	 elseif ($status =="notactive") {
	 	 echo '<div class="fail-token">Your Account is not active</div>';
	 }
}
// if the count is equal to zero
else {
	echo '<div class="fail-token">Account does not exists.</div>';
}
}
?>

<?php include('/UI/passwordreset-ui.html'); ?>
