<?php
	include "includes/db.php";
	$product_inserted = '';
	$product_inserted_error = '';
	$stock_in = 0;
	$stock_out = 0;
	session_start();
	if(!isset($_SESSION['user_id'])){
		header("Location: login.php");
		exit;
	}

	//getting categories from category table 
	$sql = "SELECT * FROM `product`";

	$query = mysqli_query($conn, $sql);
	$products = mysqli_fetch_all($query, MYSQLI_ASSOC);

	if(isset($_POST['stockin'])){
		$productname = htmlspecialchars($_POST['productname']);
		$quantity = htmlspecialchars($_POST['quantity']);


		// getting all properties of product 
		$sql_display = "SELECT * FROM `product` WHERE product_name = '$productname'";
		$query_display = mysqli_query($conn, $sql_display);
		$product_verfication = mysqli_fetch_assoc($query_display);

		//check if product inserted already
		$sql_inserted = "SELECT * FROM `stock` WHERE product_name = '$productname'";
		$query_inserted = mysqli_query($conn, $sql_inserted);

		if(mysqli_num_rows($query_inserted) > 0){
			$inserted_result = mysqli_fetch_assoc($query_inserted);
			$stock_in = $inserted_result['stock_in'] + $quantity;
			$sql_update = "UPDATE `stock` SET `stock_in`= $stock_in WHERE product_name='$productname'";
			if(mysqli_query($conn, $sql_update)){
				$product_inserted = "Product updated propery";
			}else {
				$product_inserted_error = "Product didn't updated".mysqli_error();
			}

		}else{
			$productname = $product_verfication['product_name'];
			$productcategorie = $product_verfication['product_categorie'];
			$sql_update = "INSERT INTO `stock`(`product_name`, `categorie_name`, `stock_in`, `stock_out`) VALUES ('$productname','$productcategorie',$quantity, 0)";
			if(mysqli_query($conn, $sql_update)){
				$product_inserted = "Product inserted propery";
			}else {
				$product_inserted_error = "Product didn't inserted".mysqli_error();
			}
		}
	}


	if(isset($_POST['stockout'])){
		$productname = htmlspecialchars($_POST['productname']);
		$quantity = htmlspecialchars($_POST['quantity']);

		//check if product inserted already
		$sql_inserted = "SELECT * FROM `stock` WHERE product_name = '$productname'";
		$query_inserted = mysqli_query($conn, $sql_inserted);

		if(mysqli_num_rows($query_inserted) > 0){
			$inserted_result = mysqli_fetch_assoc($query_inserted);
			if($inserted_result['stock_in'] >= ($quantity  + $inserted_result['stock_out'])){
				$stock_out = $inserted_result['stock_out'] + $quantity;
				$sql_update = "UPDATE `stock` SET `stock_out`= $stock_out WHERE product_name='$productname'";
				$query_update = mysqli_query($conn, $sql_update);
			}else {
				$product_inserted_error = "you can't remove products that aren't in";
			}

		}else{
			$product_inserted_error = "you can't remove product you didn't inserted";
		}
	}



	$sql_display = "SELECT * FROM `stock`";

	$query_display = mysqli_query($conn, $sql_display);
	$stocks = mysqli_fetch_all($query_display, MYSQLI_ASSOC);


?>
<link rel="stylesheet" type="text/css" href="css/style.css">
<?php include "includes/header.php" ?>
<?php include "includes/menu.php" ?>
<div class="section">
	<h2 style="color: lightgreen;">Stock In</h2>
	<form class="form" method="POST">
		<div>
			<label for="productname">Product Name:</label>
			<select name="productname">
				<?php foreach ($products as $product):?>
					<option value="<?=$product['product_name'] ?>"><?=$product['product_name'] ?></option>
				<?php endforeach; ?>
			</select>

		</div>
		<div>
			<label for="quantity">Quantity:</label>
			<input type="number" name="quantity" id="quantity" placeholder="Enter quantity">
		</div>
		<div>
		</div>
		<div>
			<input type="submit" name="stockin" value="Add Stock">
		</div>
	</form>
	<h2 style="color: lightgreen;">Stock Out</h2>
	<form class="form" method="POST">
		<div>
			<label for="productname">Product Name:</label>
			<select name="productname">
				<?php foreach ($products as $product):?>
					<option value="<?=$product['product_name'] ?>"><?=$product['product_name'] ?></option>
				<?php endforeach; ?>
			</select>

		</div>
		<div>
			<label for="quantity">Quantity:</label>
			<input type="number" name="quantity" id="quantity" placeholder="Enter quantity">
		</div>
		<div>
		</div>
		<div>
			<input type="submit" name="stockout" value="Remove Stock">
		</div>
	</form>
	<p style="color: red;"><?=$product_inserted_error ?? null ?></p>
	<p style="color: lightgreen;"><?=$product_inserted ?? null ?></p>
	<table>
		<tr>
			<th>#NO</th>
			<th>PRODUCT</th>
			<th>CATEGORY</th>
			<th>STOCK_IN</th>
			<th>STOCK_OUT</th>
			<th>AVAILABLE</th>
		</tr>
		<?php foreach($stocks as $stock): ?>
			<tr>
				<td><?=$stock['id']?></td>
				<td><?=$stock['product_name']?></td>
				<td><?=$stock['categorie_name']?></td>
				<td><?=$stock['stock_in']?></td>
				<td><?=$stock['stock_out']?></td>
				<td><?=$stock['available']?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>
<?php include "includes/footer.php" ?>
