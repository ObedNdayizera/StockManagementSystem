<?php
	include "includes/db.php";
	$category_inserted = '';
	session_start();
	if(!isset($_SESSION['user_id'])){
		header("Location: login.php");
		exit;
	}

	//getting categories from category table 
	$sql = "SELECT * FROM `users`";

	$query = mysqli_query($conn, $sql);
	$users = mysqli_fetch_all($query, MYSQLI_ASSOC);

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$categoryname = htmlspecialchars($_POST['categoryname']);
		$username = htmlspecialchars($_POST['username']);

		//adding product from product table
		$sql_insert = "INSERT INTO `categorie`(`categorie_name`, `user_name`) VALUES ('$categoryname','$username')";

		if(mysqli_query($conn, $sql_insert)){
			$category_inserted = "Product inserted";
		}else{
			echo "data didn't inserted".mysqli_error;
		}
	}


	$sql_display = "SELECT * FROM `categorie`";

	$query_display = mysqli_query($conn, $sql_display);
	$categories = mysqli_fetch_all($query_display, MYSQLI_ASSOC);


?>
<link rel="stylesheet" type="text/css" href="css/style.css">
<?php include "includes/header.php" ?>
<?php include "includes/menu.php" ?>
<div class="section">
	<h2 style="color: #779CAB;">Add Category</h2>
	<form class="form" method="POST">
		<div>
			<label for="categoryname">Category Name:</label>
			<input type="text" name="categoryname" id="categoryname" placeholder="Enter Category">
		</div>
		<div>
			<label for="username">User Name:</label>
			<select name="username">
				<?php foreach ($users as $user):?>
					<option value="<?=$user['user_name'] ?>"><?=$user['user_name'] ?></option>
				<?php endforeach; ?>
			</select>

		</div>
		<div>
		</div>
		<div>
			<input type="submit" name="submit" value="Add Category">
		</div>
	</form>
	<p style="color: #779CAB;"><?=$category_inserted ?? null ?></p>
	<table>
		<tr>
			<th>#NO</th>
			<th>CATEGORY NAME</th>
			<th>USERNAME</th>
			<th>ACTION</th>
		</tr>
		<?php foreach($categories as $category): ?>
			<tr>
				<td><?=$category['id']?></td>
				<td><?=$category['categorie_name']?></td>
				<td><?=$category['user_name']?></td>
				<td>
					<a href="update_category.php?id=<?=$category['id']?>">update</a>
					<a href="delete_category.php?id=<?=$category['id']?>">delete</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>
<?php include "includes/footer.php" ?>
