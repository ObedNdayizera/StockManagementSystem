<?php
include "includes/db.php";
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$id = $_SESSION['user_id'];
$sql = "SELECT * FROM Users WHERE UserId=$id";
$query = $conn->query($sql);
$user = mysqli_fetch_assoc($query);

if($_SERVER["REQUEST_METHOD"] == "update"){
    $username = htmlspecialchars($_POST['']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> FC</title>
    <style>
        body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        color: #333;
        margin: 0;
        padding: 0;
        }

        header {
            background-color: #759FBC;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 30px 20px 10px 20px;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            margin-bottom: 10px;
        }

        nav ul li {
            display: inline;
            margin-right: 10px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        main {
            padding: 20px;
        }

        h2, h1 {
            color: #333;
            text-transform: capitalize;
            font-weight: 500;
        }

        h2 {
            margin-left: 35px;
        }
        .logos_container{
            display: flex;
        }
        .profile {
            width: 20px;
            height: 20px;
            background: #f4f4f4;
            padding: 5px;
            border-radius: 50%;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .logo {
            padding-right: 10px;
            width: 40px;
            height: 40px;
            margin-top: -10px;
        }
        .title_beauty {
            font-weight: 900;
            font-size: 15px;
            margin-bottom: -20px;
        }

        .profile_container {
            display: grid;
            grid-template-columns: 30% 70%;
        }

        h1 {
            margin-bottom: 50px;
        }

        .img_div {
            width: 150px;
            height: 150px;
            background: #999;
            padding: 10px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .user_profile {
            width: 85px;
            height: 85px;
        }
        


        footer {
            background-color: #759FBC;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }
        form div {
            display: flex;
            flex-direction: column;
        }

        form div label {
            margin-bottom: 5px;
            font-size: 15px;
            font-weight: 600;
            color: #555;
        }
         
        form div input, form input {
            width: 70%;
            margin-bottom: 15px;
            padding: 8px;
            border: none;
            background: #c6d3da;
            outline: none;
            border-radius: 3px;
        }

        form input {
            width: 73.5%;
        }

        .links {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
        }

        .links a{
            text-decoration: none;
            color: #1F5673;
        }
    </style>
</head>
<body>
    <header>
        <div class="logos_container">
            <img class="logo" src="images/logo.png" alt="BEAUTY WAREHOUSE">
            <small class="title_beauty">BEAUTY WAREHOUSE</small>
        </div>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="view_candidates.php">Manage Candidates</a></li>
                <li><a href="view_posts.php">Manage Posts</a></li>
                <li><a href="view_candidate_result.php">Manage Results</a></li>
                <li><a href="report.php">Generate Report</a></li>
            </ul>
        </nav>
        <a href="profile.php"><img class="profile" src="images/profile.svg" alt="profile"></a>
    </header>
    <main>
<div class="profile_container">
    <div>
        <div class="img_div"><img src="images/profile.svg" alt="profile" class="user_profile"></div>
        <h2><?=$user['UserName']?></h2>
    </div>
    <div >
        <h1>My Profile</h1>
        <form action="">
            <div>
                <label for="">USER NAME</label>
                <input type="text" name="username" id="">
            </div>
            <div>
                <label for="">EMAIL</label>
                <input type="text" name="username" id="">
            </div>
            <div>
                <label for="">PASSWORD</label>
                <input type="text" name="username" id="">
            </div>
            <div>
                <label for="">PASSWORD CONFIRMATION</label>
                <input type="text" name="username" id="">
            </div>
            <input type="submit" value="Update" name="update">
        </form>
        <div class="links">
            <a href="logout.php"><small>Logout</small></a>
            <a href="Delete_accout.php?id=<?=$user['UserId']?>"><small>Delete Account</small></a>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
