<?php
include("function.php");
$user=new user;
session_start();
$admin_name=$_SESSION['admin-name'];
$admin_categore=$_SESSION['admin-cat'];
$admin_stat=$_SESSION['admin-stat'];
$email=$_SESSION['email'];
if($admin_stat == 0)
{
	header("Location:index.php");
	$_SESSION['msg'] = "Your Are Not authorized";
}
elseif($admin_categore == "")
{
	header("Location:index.php");
	$_SESSION['msg'] = "Your Are Not authorized";
}
elseif($admin_categore == "sub-admin")
{
	header("Location:index.php");
	$_SESSION['msg'] = "Your Are Not authorized";
}
else
{
	echo "";
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Create Menu</title>
<link rel="stylesheet" type="text/css" href="css/admin.css">
</head>

<body>
<div id="main-contain">
    <div class="heading">
        <h1>Create Menu</h1>
        <h5 class="user-name">
			<?php
                echo $admin_name;
            ?>
        </h5>
        <h5>
			<?php echo "<a href='logout.php'>Logout</a>"; ?>
        </h5>
    </div>

    <div class="message">
        <h1>
			<?php
                if(@$msg)
                {
                    echo $msg;
                }
            ?>
        </h1>
    </div>
    <div id="from">

    </div>

    <div class="bottom-nav">
        <h3><a href="admin_menu.php">Go Back</a></h3>
    </div>
</div>
</body>
</html>