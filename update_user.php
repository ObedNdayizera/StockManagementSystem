<?php
	include "includes/db.php";
	session_start();
	if(!isset($_SESSION['user_id'])){
		header("Location: login.php");
		exit;
	}
	if(isset($_GET['id'])){
		$id = $_GET['id'];

		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$username = htmlspecialchars($_POST['username']);
			$position = htmlspecialchars($_POST['position']);

			//updating user from user table
			$sql_update = "UPDATE `users` SET `user_name`='$username',`user_position`='$position' WHERE id=$id";

			if(mysqli_query($conn, $sql_update)){
				header('Location: user.php');
				exit;
			}else{
				echo "product didn't updated".mysqli_error;
			}
		}

		$sql_display = "SELECT * FROM `users` WHERE id='$id'";

		$query_display = mysqli_query($conn, $sql_display);
		$user = mysqli_fetch_assoc($query_display);

		$user_name = $user['user_name'];
		$user_position = $user['user_position'];

	}else {
		die("You are on the wrong page");
	}

?>

<link rel="stylesheet" type="text/css" href="css/style.css">
<?php include "includes/header.php" ?>
<?php include "includes/menu.php" ?>
<div class="section">
	<h2 style="color: lightgreen;">Add user</h2>
	<form class="form" method="POST">
		<div>
			<label for="username">Username:</label>
			<input type="text" name="username" id="username" placeholder="Enter full name" value="<?php echo $user_name ?>">
		</div>
		<div>
			<label for="position">Position:</label>
			<input type="text" name="position" id="position" placeholder="Enter Position" value="<?php echo $user_position ?>">
		</div>
		<div>
		</div>
		<div>
			<input type="submit" name="submit" value="Update User">
		</div>
	</form>
</div>
<?php include "includes/footer.php" ?>