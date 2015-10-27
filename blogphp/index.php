<?php
include("function.php");

$user=new user;
session_start();
@$msg= $_SESSION['msg'];

if(isset($_POST['submit']))
{
	extract($_POST);
	
	$admin_signin= $user->admin_signin($email,$pass);
	if($admin_signin)
	{
		header("Location:home.php");
	}
	elseif (!$admin_signin)
	{
		$user_sign_in= $user->user_sign_in($email,$pass);
		header("Location:home.php");
	}	
	elseif($email == "")
	{
		$msg="Plse Enter Your Email Correctly";
	}
	elseif($pass == "")
	{
		$msg="Plse Enter Your Password Correctly";
	}
	else
	{
		$msg = "Your Email Or Password Is Wrong";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Signin</title>
<link rel="stylesheet" type="text/css" href="css/admin.css">
</head>

<body>
<div id="main-contain">
    <div class="heading">
        <h1>Sign In</h1>
    </div>
	<div class="message">
        <h1>
			<?php
                if(@$msg)
                {
                    echo $msg;
					if(@$_SESSION['msg'])
					{
						echo $_SESSION['msg'] ="";
						session_destroy();
					}
                }
            ?>
        </h1>
    </div>
    <div id="from">
        <form action="" method="post">
        <input class="email" type="email" name="email" placeholder="Enter Your Email">
        <br><br>
        <input class="pass" type="password" name="pass" placeholder="Enter Your Password">
        <br><br>
        <input class="submit" type="submit" name="submit">
        </form>
    </div>
    <div class="bottom-nav">
        <h3><a href="user_signup.php">Sign Up Hear </a></h3>
    </div>
</div>
</body>
</html>