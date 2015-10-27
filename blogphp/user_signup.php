<?php
include("function.php");
$user= new user;

if(isset($_POST['submit']))
{
	extract($_POST);
	$user->user_signup($name,$email,$pass);
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>User Signup</title>
<link rel="stylesheet" type="text/css" href="css/admin.css">
</head>

<body>
<div id="main-contain">
    <div class="heading">
        <h1>Sign Up</h1>
    </div>
    
    <div id="from">
        <form action="" method="post">
        <input class="name" type="text" name="name" placeholder="Your Name">
        <br><br>
        <input class="email" type="email" name="email" placeholder="Your Email">
        <br><br>
        <input class="pass" type="password" name="pass" placeholder="Your PassWord">
        <br><br>
        <input class="submit" type="submit" name="submit">
        </form>
    </div>
    <div class="bottom-nav">
        <h3><a href="index.php">Go Back</a></h3>
    </div>
</div>
</body>
</html>