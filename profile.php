<?php
	include "includes/db.php";
	session_start();
	if(!isset($_SESSION['user_id'])){
		header("Location: login.php");
		exit;
	}

    $id = $_SESSION['user_id'];

	$sql = "SELECT * FROM `users` WHERE id=$id";
	$query = mysqli_query($conn, $sql);

	$user = mysqli_fetch_assoc($query);
?>
<link rel="stylesheet" type="text/css" href="css/style.css">
<?php include "includes/header.php" ?>
<?php include "includes/menu.php" ?>
<style>
    form {
        width: 50%;
    }

    form div {
        margin-bottom: 15px;
    }

    form div:last-child {
        display: flex;
        justify-content: space-between;
        padding-top: 50px;
    }

    form div button{
        padding: 8px;
        cursor: pointer;
        background-color: lightgreen;
        border: 1px solid lightgreen;
        border-radius: 5px;
    }

    form div input {
        padding: 8px;
        width: 100%;
        border: 1.5px solid #888;
        border-radius: 5px;
        margin-top: 5px;
    }
</style>
<div class="section">
	<h2 style="color: lightgreen;">Account Settings</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div>
            <small><strong>Your Name:</strong></small><br>
            <input type="text" value="<?=$user['user_name']; ?>">
        </div>
        <div>
            <small><strong>Password:</strong></small><br>
            <input type="password" value="<?=$user['user_password']; ?>">
        </div>
        <div>
            <small><strong>Email Address:</strong></small><br>
            <input type="text" value="<?="example@gmail.com"?>">
        </div>
        <div>
            <button>Update Account</button>
            <button>Delete Account</button> 
        </div>
        
    </form>
</div>
<?php include "includes/footer.php" ?>
