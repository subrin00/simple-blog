<?php
include('function.php');

$user= new user;

session_start();
$user_name =$_SESSION['user-name'];
$email = $_SESSION['uemail'];


if($user_name == "" || $email == "")
{
	header("Location:index.php");
	$_SESSION['msg'] = "Your Are Not authorized";
}
else
{
	echo "";
}
if(isset($_POST['submit']))
{
	extract($_POST);
	$show = $user->mainpost($title,$fileToUpload,$description);
	if($show)
	{
		$msg = "Submit Successfully";
		//echo "<meta http-equiv='refresh' content='0'>";
	}
	else
	{
		$msg ="Submit Fail";
	}
}
elseif(isset($_GET['del']))
{
    $del = $_GET['del'];
    $user->delete_main_post($del);
    header("Location:main_post.php");
    $_SESSION['msg'] = "Post Delete Successfully";
}
elseif (isset($_GET['edit'])) 
{
    if(isset($_POST['update']))
    {
        $edit = $_GET['edit'];
        extract($_POST);
        $edit_post = $user->edit_main_post($edit,$title,$fileToUpload,$description);
        if ($edit_post) 
        {
            header("Location:main_post.php");
            $_SESSION['msg'] = "Post Update Successfully";
        }
    }
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
<title>Main Post Page</title>
<link rel="stylesheet" type="text/css" href="css/admin.css">
</head>

<body>
<div id="main-contain">
    <div class="heading">
        <h1>Main Post</h1>
        <h5 class="user-name">
			<?php
            if (isset($_SESSION['user-name'])) 
            {
                $user_name =$_SESSION['user-name'];
                echo $user_name;
            }                
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
                    if(@$_SESSION['msg'])
                    {
                        echo $_SESSION['msg'] = "";
                    }
                }
            ?>
        </h1>
    </div>
	<div id="from">
        <form action="" method="post" enctype="multipart/form-data">
        <?php if(isset($_GET['edit']))
        {
            $edit = $_GET['edit'];
            $user->show_edit_main_post($edit);
        }else{ ?>
        <input class="title" type="text" name="title" placeholder="Enter Your Post Title">
        <br><br>
        <input class="img" type="file" name="fileToUpload">
        <br><br>
        <input class="des" type="text" name="description" placeholder="Enter Your Post Description">
        <br><br>
        <input class="submit" type="submit" name="submit">
        <?php } ?>
        </form>
    </div>
    
    <div class="bottom-nav">
        <h3><a href="home.php">Go Back</a></h3>
    </div>
    
    <div class="admin-bar">
        <?php if (isset($_GET['mid'])) 
        {
            $mid = $_GET['mid'];
            $user->show_main_post($mid,'');
        } ?>
    </div>

    <div class="bottom-nav">
        
    </div>
</div>
</body>
</html>