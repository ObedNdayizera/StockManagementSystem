<?php
	include "includes/db.php";
	session_start();
	if(!isset($_SESSION['user_id'])){
		header("Location: login.php");
		exit;
	}

	if(isset($_GET['id'])){
		$id = $_GET['id'];
		//getting categories from category table 
		$sql = "SELECT * FROM `categorie` WHERE id=$id";

		$query = mysqli_query($conn, $sql);
		$categorie = mysqli_fetch_assoc($query);

		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$categoryname = htmlspecialchars($_POST['categoryname']);
			$username = htmlspecialchars($_POST['username']);

			//adding product from product table
			$sql_update = "UPDATE `categorie` SET `categorie_name`='$categoryname',`user_name`='$username' WHERE id=$id";

			if(mysqli_query($conn, $sql_update)){
				header('Location: category.php');
				exit;
			}else{
				echo "category didn't updated".mysqli_error;
			}
		}


		$sql_display = "SELECT * FROM `users`";

		$query_display = mysqli_query($conn, $sql_display);
		$users = mysqli_fetch_all($query_display, MYSQLI_ASSOC);

	}

?>
<link rel="stylesheet" type="text/css" href="css/style.css">
<?php include "includes/header.php" ?>
<?php include "includes/menu.php" ?>
<div class="section">
	<h2 style="color: #779CAB;">Update Category</h2>
	<form class="form" method="POST">
		<div>
			<label for="categoryname">Category Name:</label>
			<input type="text" name="categoryname" id="categoryname" value="<?=$categorie['categorie_name']?>">
		</div>
		<div>
			<label for="username">User Name:</label>
			<select name="username" <??>>
				<?php foreach ($users as $user):?>
					<option 
					value="<?=$user['user_name'] ?>"
					<?=($user['user_name']  == $categorie['user_name'])? "selected" : null?>
					>
					<?=$user['user_name'] ?>
					</option>
				<?php endforeach; ?>
			</select>

		</div>
		<div>
		</div>
		<div>
			<input type="submit" name="submit" value="Update Category">
		</div>
	</form>
</div>
<?php include "includes/footer.php" ?>
