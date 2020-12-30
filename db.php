<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gub";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS MyMessages (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(30) NOT NULL,
user_id VARCHAR(30) NOT NULL,
msg VARCHAR(256) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {

} else {
  echo "Error creating table: " . $conn->error;
}

function esc_data($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if( isset( $_POST["your-message"] ) ){
	$username = $_SESSION["username"];
	$user_id = $_SESSION['user_id'];
	$message = esc_data($_POST['your-message']);

	$sql = "INSERT INTO MyMessages (username, user_id, msg) VALUES ('$username', '$user_id', '$message')";
	if ($conn->query($sql) === TRUE) {

	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

