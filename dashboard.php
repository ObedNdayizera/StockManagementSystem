<?php
	include "includes/db.php";
	$product_inserted = '';
	session_start();
	if(!isset($_SESSION['user_id'])){
		header("Location: login.php");
		exit;
	}

	//getting categories from category table 
	$sql = "SELECT * FROM `categorie`";

	$query = mysqli_query($conn, $sql);
	$categories = mysqli_fetch_all($query, MYSQLI_ASSOC);

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$productname = htmlspecialchars($_POST['productname']);
		$productcategorie = htmlspecialchars($_POST['productcategorie']);
		$productdate = htmlspecialchars($_POST['productdate']);

		//adding product from product table
		$sql_insert = "INSERT INTO `product`(`product_name`, `product_categorie`, `date`) VALUES ('$productname','$productcategorie','$productdate')";

		if(mysqli_query($conn, $sql_insert)){
			$product_inserted = "Product inserted";
		}else{
			echo "data didn't inserted".mysqli_error;
		}
	}


	$sql_display = "SELECT * FROM `product`";

	$query_display = mysqli_query($conn, $sql_display);
	$products = mysqli_fetch_all($query_display, MYSQLI_ASSOC);


?>
<link rel="stylesheet" type="text/css" href="css/style.css">
<?php include "includes/header.php" ?>
<?php include "includes/menu.php" ?>
<div class="section">
	<h2 style="color: #779CAB;">Add Product</h2>
	<form class="form" method="POST">
		<div>
			<label for="productname">Product Name:</label>
			<input type="text" name="productname" id="productname" placeholder="Enter a Product">
		</div>
		<div>
			<label for="productcategorie">Product Category:</label>
			<select name="productcategorie">
				<?php foreach ($categories as $categorie):?>
					<option value="<?=$categorie['categorie_name'] ?>"><?=$categorie['categorie_name'] ?></option>
				<?php endforeach; ?>
			</select>

		</div>
		<div>
			<label>Date:</label>
			<input type="Date" name="productdate">
		</div>
		<div>
			<input type="submit" name="submit" value="Add Product">
		</div>
	</form>
	<p style="color: #779CAB;"><?=$product_inserted ?? null ?></p>
	<table>
		<tr style="background: #779CAB;">
			<th>#NO</th>
			<th>PRODUCT</th>
			<th>CATEGORY</th>
			<th>DATE</th>
			<th>ACTION</th>
		</tr>
		<?php foreach($products as $product): ?>
			<tr>
				<td><?=$product['id']?></td>
				<td><?=$product['product_name']?></td>
				<td><?=$product['product_categorie']?></td>
				<td><?=$product['date']?></td>
				<td>
            		<a href="update_product.php?id=<?php echo $product['id'] ?>">Update</a>
            		<a href="delete_product.php?id=<?php echo $product['id'] ?>">delete</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>
<?php include "includes/footer.php" ?>
