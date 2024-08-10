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
		$sql = "SELECT * FROM `categorie`";

		$query = mysqli_query($conn, $sql);
		$categories = mysqli_fetch_all($query, MYSQLI_ASSOC);

		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$productname = htmlspecialchars($_POST['productname']);
			$productcategorie = htmlspecialchars($_POST['productcategorie']);
			$productdate = htmlspecialchars($_POST['productdate']);

			//adding product from product table
			$sql_update = "UPDATE `product` SET `product_name`='$productname',`product_categorie`='$productcategorie',`date`='$productdate' WHERE id=$id";

			if(mysqli_query($conn, $sql_update)){
				header('Location: dashboard.php');
				exit;
			}else{
				echo "product didn't updated".mysqli_error;
			}
		}

		$sql_display = "SELECT * FROM `product` WHERE id=$id";

		$query_display = mysqli_query($conn, $sql_display);
		$product = mysqli_fetch_assoc($query_display);

	}else {
		die("You are on the wrong page");
	}

?>
<link rel="stylesheet" type="text/css" href="css/style.css">
<?php include "includes/header.php" ?>
<?php include "includes/menu.php" ?>
<div class="section">
	<h2 style="color: lightgreen;">Add Product</h2>
	<form class="form" method="POST">
		<div>
			<label for="productname">Product Name:</label>
			<input type="text" name="productname" id="productname" value="<?=$product['product_name']?>">
		</div>
		<div>
			<label for="productcategorie">Product Category:</label>
			<select name="productcategorie">
				<?php foreach ($categories as $categorie):?>
					<option 
					value="<?=$categorie['categorie_name'] ?>"
					<?php echo $product['product_categorie'] == $categorie['categorie_name'] ? "selected" : null?>
					> 
					<?=$categorie['categorie_name'] ?>
						
					</option>
				<?php endforeach; ?>
			</select>

		</div>
		<div>
			<label>Date:</label>
			<input type="Date" name="productdate" value="<?=$product['date']?>">
		</div>
		<div>
			<input type="submit" name="submit" value="Update Product">
		</div>
	</form>
</div>
<?php include "includes/footer.php" ?>
