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
        background-color: #fff;
        border: 1.5px solid #888;
        border-radius: 5px;
    }

    form div button:last-child {
        background-color: #779CAB;
        border: 1.5px solid #779CAB;
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
	<h2 style="color: #779CAB;">Account Settings</h2>
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
            <a href="update_user.php?id=<?=$id?>"><button>Update Account</button></a>
            <a href="delete_user.php?id=<?=$id?>"><button>Delete Account</button></a>
        </div>
        <div>
            <img src="" alt="">
        </div>
    </form>
    <div>

    </div>
</div>
<?php include "includes/footer.php" ?>
