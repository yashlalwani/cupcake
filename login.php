<?php 
// Database Connection Required For Login Algorithm.
require_once('/structures/dbconnect.php'); ?>
<?php
session_start();

if (isset($_SESSION['logged'])) {
     header('location: /');
}

if (isset($_POST['token-submit'])) {
    // getting date 
     $date = date("d-m-y");
    // getting email and password in variables
  $email = mysqli_real_escape_string($conn, $_POST['email-token']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password-token']));
 
    // passing the query in order to fetch and match the database information and user input
    $login_query = mysqli_query($conn, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");
    // getting the count of the rows when the query is passed 
    
    $get_count = mysqli_num_rows($login_query);
    
    // checking wether count is equal to 1 or not
    if ($get_count==1) {

      // creating an associative array of the user information fetched from the database
      $rows = mysqli_fetch_assoc($login_query);
          
          // fetching the status of the verification of the user's Email Address
          $status = mysqli_real_escape_string($conn, $rows['status']);

           // if the status field has a value which is = active

          if ($status=="active") {
               echo '<div class="success-token">You have logged in</div>';
               $_SESSION['logged'] = "true";
               $_SESSION['name'] = mysqli_real_escape_string($conn, $rows['name']);
               $_SESSION['email'] = mysqli_real_escape_string($conn, $rows['email']);
               $_SESSION['status'] = mysqli_real_escape_string($conn, $rows['status']);

               $date_update = mysqli_query($conn, "UPDATE `users` SET `lastlogin` = '$date' WHERE `email` = '$email'");
               header('Location: /');
          }

           // if the status field has a value which is = notactive
          elseif ($status=="notactive") {
               echo '<div class="fail-token">Your account is blocked.</div>';
          }

    }

    // if the count is = 0
    else
          {
             echo '<div class="fail-token">Email Address or Password is Wrong</div>';
          }
}

include('UI/login-form.html'); 
?>