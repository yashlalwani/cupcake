<?php require_once('dbconnect.php'); ?>
<?php
// Tables would get created automatically once this file gets executed.
// Execute this file only when the database configuration is done and is working flawlessly.
// Total of 2 tables would be created once this file gets executed.
// Please make sure that none of the table name matches the existing table in your server's Database.

$main_users_table = mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `users` (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
name VARCHAR(50) NOT NULL,
email VARCHAR(50) NOT NULL,
password VARCHAR(50) NOT NULL,
status TEXT(50) NOT NULL,
creationdate VARCHAR(50) NOT NULL,
lastlogin VARCHAR(50) NOT NULL
)");

// Password will be stored in form of MD5 Hash Datatype.
// Function is passed in the signup algorithm.

$main_resetpassword_table = mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `resetpwd` (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
datacode VARCHAR(255) NOT NULL,
email VARCHAR(255) NOT NULL
)");

// Reset password table is created and later manipulated to store password reset tokens.
// Reset the exiting password of the user to a new choiced password of the user.

// condition passed to check wether the SQL Queries made to create tables are true.
if ($main_users_table==TRUE && $main_resetpassword_table==TRUE) {
	 echo 'Table Structures have been successfully created and Configured in Your Server Database';
}
// Error Because database configuration is not properly done or the tables already exists.
else {
	  echo 'There is a Problem with the database credentials configuration or Tables already exists. Please Try Again';
}

// Delete this file once the tables have been successfully created in your server database.

// <> With <3 By NameGrill Technologies Network
?>