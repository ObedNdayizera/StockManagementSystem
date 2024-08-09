<?php 
	$conn = mysqli_connect("localhost", "root", "", "ims");

	if(!$conn){
		echo "connection failed".mysqli_connect_error();
	}
 ?>