<?php
	include 'includes/db.php';
	session_start();
	$error = "";
	if($_SERVER['REQUEST_METHOD'] === "POST"){
		$username = htmlspecialchars($_POST['username']);
		$password = htmlspecialchars($_POST['password']);

		$sql = "SELECT * FROM `users` WHERE user_name = '$username'";
		$query = mysqli_query($conn, $sql);
		$user = mysqli_fetch_assoc($query);

		if(mysqli_num_rows($query) > 0){
			if(password_verify($password, $user['user_password'])){
				session_regenerate_id();
				$_SESSION['user_id'] = $user['id'];

				header("Location: dashboard.php");
				exit;
			}else {
				$error = "invalid password or username";
			}
		}else{
			$error = "invalid password or username";
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
		<h2>Member Login</h2>
		<?php echo "<small style='color: red; margin-left: -7.3rem;'>".$error ."</small>"?? null?>
		<input type="text" name="username" placeholder="Name" value="<?=$username?>">
		<input type="password" name="password" placeholder="Password">
		<input type="submit" name="signup">
		<small style="color: #777">forget password? Click to reset</small>
		<div>
			<a href="signup.php" class="btn"><small>Create Account</small></a>
		</div>
	</form>
</body>
</html>