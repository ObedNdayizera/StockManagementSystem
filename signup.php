<?php
	include 'includes/db.php';
	$confirm_password_error = "";
	if($_SERVER['REQUEST_METHOD'] === "POST"){
		$username = htmlspecialchars($_POST['username']);
		$position = htmlspecialchars($_POST['position']);
		$password = htmlspecialchars($_POST['password']);
		$confirm_password = htmlspecialchars($_POST['confirm_password']);


		if(!($password == $confirm_password)){
			$confirm_password_error = "passwords must match";
		}else {
			$password = password_hash($password, PASSWORD_DEFAULT);
			$sql = "INSERT INTO `users`(`user_name`, `user_password`, `user_position`) VALUES ('$username','$password','$position')";

			if (mysqli_query($conn, $sql)) {
				header("Location: login.php");
			}else{
				die("insert failed".mysqli_error);
			}
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>login</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<form class="form_container" method="POST" action="">
		<div class="profile">
			<img src="img/profile.svg">
		</div>
		<h2>Member signup</h2>
		<?php echo "<small style='color: red; margin-left: -9.5rem;'>".$confirm_password_error ."</small>"?? null?>
		<input type="text" name="username" placeholder="Name" required>
		<input type="text" name="position" placeholder="Position" required>
		<input type="password" name="password" placeholder="Password" required>
		<input type="password" name="confirm_password" placeholder="Confirm Password" required>
		<input type="submit" name="signup">
		<small style="color: #777">forget password? Click to reset</small>
		<div>
			<a href="login.php" class="btn"><small>Already have an account</small></a>
		</div>
	</form>
</body>
</html>