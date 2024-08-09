<?php
	include "db.php";
	$id = $_SESSION['user_id'];

	$sql = "SELECT * FROM `users` WHERE id=$id";
	$query = mysqli_query($conn, $sql);

	$user = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Stock</title>
    <!-- <link rel="stylesheet" href="css/style.css"> -->
</head>
<body>
	<div class="container">
		<div class="header">
			<h2>Welcome, <?=$user['user_name']; ?></h2>
			<img src="img/profile.svg" class="img" alt="profile">
		</div>
