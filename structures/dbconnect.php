<?php
// Cupcake is under the Open Source License <> By NameGrill Technologies Network.
// This is the database connection file.
// Its Recommended to upload the files to a proper or a localhost server first.
// Configure this file properly by changing the variable values to your server Databse Details.
// Database tables won't be created until this file hasn't been configured properly.
// You can make changes if you want for better understandibility and proper configuration.

$servername = "servername/hostname";
$username = "username";
$password = "password";
$dbname = "database name";

// Create connection to the server's database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Checking the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// No Error Means that Database has been successfully Connected.
// Once the database has been successfully configured, Run the tablescreation.php file in the structures directory to create the necessary tables to let the algorithms work further. Delete the tablescreation file once the tables have been created.
?>
