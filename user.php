<?php
	include "includes/db.php";
	$category_inserted = '';
	session_start();
	if(!isset($_SESSION['user_id'])){
		header("Location: login.php");
		exit;
	}

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$username = htmlspecialchars($_POST['username']);
		$position = htmlspecialchars($_POST['position']);

		//adding product from product table
		$sql_insert = "INSERT INTO `users`(`user_name`, `user_password`, `user_position`) VALUES ('$username','1234','$position')";

		if(mysqli_query($conn, $sql_insert)){
			$user_inserted = "User inserted";
		}else{
			echo "data didn't inserted".mysqli_error;
		}
	}


	$sql_display = "SELECT * FROM `users`";

	$query_display = mysqli_query($conn, $sql_display);
	$users = mysqli_fetch_all($query_display, MYSQLI_ASSOC);


?>
<link rel="stylesheet" type="text/css" href="css/style.css">
<?php include "includes/header.php" ?>
<?php include "includes/menu.php" ?>
<div class="section">
	<h2 style="color: lightgreen;">Add user</h2>
	<form class="form" method="POST">
		<div>
			<label for="username">Username:</label>
			<input type="text" name="username" id="username" placeholder="Enter full name">
		</div>
		<div>
			<label for="position">Position:</label>
			<input type="text" name="position" id="position" placeholder="Enter Position">
		</div>
		<div>
		</div>
		<div>
			<input type="submit" name="submit" value="Add User">
		</div>
	</form>
	<p style="color: lightgreen;"><?=$category_inserted ?? null ?></p>
	<table>
		<tr>
			<th>#NO</th>
			<th>USER NAME</th>
			<th>POSITION</th>
			<th>ACTION</th>
		</tr>
		<?php foreach($users as $user): ?>
			<tr>
				<td><?=$user['id']?></td>
				<td><?=$user['user_name']?></td>
				<td><?=$user['user_position']?></td>
				<td>
					<a href="update_user.php?id=<?=$user['id']?>">update</a>
					<a href="delete_user.php?id=<?=$user['id']?>">delete</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>
<?php include "includes/footer.php" ?>
