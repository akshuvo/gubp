<?php 
session_start();
require_once('db.php');
	if( isset( $_SESSION["username"] ) && isset( $_SESSION["user_id"] ) ) : ?>
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
				  	<div class="message <?php echo $classes; ?>" title="Sent on <?php echo date("d M, Y", strtotime($row['reg_date'])); ?>">
				  		<div class="txt"><?php echo str_replace("\n", "<br>", $row['msg']); ?></div>
				  		<div class="name"><?php echo $row['username']; ?></div>
				  		<div class="date"><?php echo $row['reg_date']; ?></div>
				  	</div>

			  	<?php }
			} else {
			  echo "<div class='no-message'>No Messages</div>";
			}
			?>

	
	</div>
	<?php endif; ?>