<?php 
session_start();
require_once('db.php');


// Insert MSG
if( isset( $_POST["your-message"] ) ){
	$username = $_SESSION["username"];
	$user_id = $_SESSION['user_id'];
	$message = esc_data($_POST['your-message']);

	$sql = "INSERT INTO MyMessages (username, user_id, msg) VALUES ('$username', '$user_id', '$message')";
	if ($conn->query($sql) === TRUE) {
		echo "true";
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}
}