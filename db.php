<?php
// Do Connection
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "local";

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

// Escape Function
function esc_data($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Redirect
function redirect(){
	$url = "http://$_SERVER[HTTP_HOST]/gubp/";
	header("Location: {$url}");
	die();
}

// Set Session
if( isset( $_POST["your-name"] ) ){
	$_SESSION["username"] = esc_data($_POST["your-name"]);
	$_SESSION['user_id'] = uniqid();

}


// Reset Session
if( isset( $_GET['exit'] ) ){
	session_destroy();
	redirect();
}
