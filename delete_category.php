<?php
	include 'includes/db.php';
	session_start();
	if (!isset($_SESSION['user_id'])) {
		header("Location: login.php");
		exit;
	}

	if(isset($_GET['id'])){
		$id = $_GET['id'];

		$sql = "DELETE FROM `categorie` WHERE id=$id";

		if(mysqli_query($conn, $sql)){
			header("Location: category.php");
		}else {
			echo "row didn't deleted";
		}
	}else {
		die("Your on the wrong page.");
	}
?>