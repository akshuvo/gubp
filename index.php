<?php
session_start();
require_once('db.php');


if( isset( $_POST["your-name"] ) ){
	$_SESSION["username"] = esc_data($_POST["your-name"]);
	$_SESSION['user_id'] = uniqid();

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Anonymouse ChatBox</title>
	<style>
body {
    max-width: 400px;
    margin: 0 auto;
    background: #ddd;
}
.message.isme {
    text-align: right;
    float: right;
}

.message {
    box-shadow: 0 0 4px rgb(51 51 51 / 0.3);
    padding: 15px 25px;
    float: left;
    width: auto;
    clear: both;
    margin: 10px 0px;
    max-width: 85%;
}

.messages-wrap {
    overflow: hidden;
    clear: both;
    width: 100%;
    background: #fff;
}

form {
    width: 100%;
    clear: both;
    margin-top: 15px;
    float: none;
}

textarea {
    width: 100%;
}
body,
html {
    height: 100%;
}

.welcome-form {
    height: 100%;
    text-align: center;
}
.msg-form input[type="submit"] {
    margin-bottom: 10px;
    width: 100%;
}

* {
    box-sizing: border-box;
}
	</style>
</head>
<body>

	<?php if( isset( $_SESSION["username"] ) && isset( $_SESSION["user_id"] ) ) : ?>
		<div class="messages-wrap">
		<?php
		$user_id = esc_data($_SESSION['user_id']);
		$sql = "SELECT * FROM MyMessages";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {

			while($row = $result->fetch_assoc()) { ?>
			  	<?php
			  	//print_r($row);
			  	$classes = " ";
			  	if ( $row['user_id'] == $user_id ) {
			  		$classes .= " isme ";
			  	}

			  	?>
			  	<div class="message <?php echo $classes; ?>">
			  		<div class="txt"><?php echo $row['msg']; ?></div>
			  		<div class="name"><?php echo $row['username']; ?></div>
			  		<div class="name"><?php echo $row['reg_date']; ?></div>
			  	</div>

		  	<?php }
		} else {
		  echo "0 results";
		}
		?>

		<form class="msg-form" method="post">
			<textarea name="your-message" placeholder="Type Message..." rows="5"></textarea>
			<input type="submit" value="Send">
		</form>
	</div>
	<?php else: ?>
		<form class="welcome-form" method="post">
			<h3>Welcome to Anonymouse ChatBox</h3>
			<label>Enter Your Name: <input type="text" name="your-name"></label>
			<input type="submit" value="Enter">
		</form>
	<?php endif; ?>



</body>
</html>