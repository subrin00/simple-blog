<?php
include('function.php');

$user= new user;

session_start();
@$msg = $_SESSION['msg'];

if (isset($_SESSION['email'])) 
{
    $email=$_SESSION['email'];
    if($email == "")
    {
        header("Location:index.php");
        $_SESSION['msg'] = "Your Are Not authorized";
    }
}
if (isset($_SESSION['uemail'])) 
{
    $email=$_SESSION['uemail'];
    if($email == "")
    {
        header("Location:index.php");
        $_SESSION['msg'] = "Your Are Not authorized";
    }
}

if (isset($_GET['aid'])) 
{
    $aid = $_GET['aid'];
    if(isset($_POST['submit']))
    {
    	extract($_POST);        
    	$show = $user->mainpost($aid,$title,$fileToUpload,$description,$date,$time);
    	if($show)
    	{
    		header("Location:main_post.php?aid=$aid");
    		$_SESSION['msg'] = "Submit Successfully";
    	}
    	else
    	{
    		header("Location:main_post.php?aid=$aid");
            $_SESSION['msg'] = "Submit Fail";
    	}
    }
    elseif(isset($_GET['del']))
    {
        $del = $_GET['del'];
        $user->delete_main_post($del);
        header("Location:main_post.php?aid=$aid");
        $_SESSION['msg'] = "Post Delete Successfully";
    }
    elseif (isset($_GET['edit'])) 
    {
        if(isset($_POST['update']))
        {
            $edit = $_GET['edit'];
            extract($_POST);
            $edit_post = $user->edit_main_post($aid,$edit,$title,$fileToUpload,$description,$date,$time);
            if ($edit_post) 
            {
                header("Location:main_post.php?aid=$aid");
                $_SESSION['msg'] = "Post Update Successfully";
            }
        }
    }
    else
    {
        echo "";
    }
}


if (isset($_GET['uid'])) 
{
    $uid = $_GET['uid'];
    if(isset($_POST['submit']))
    {        
        extract($_POST);
        $show = $user->user_post($uid,$title,$fileToUpload,$description,$date,$time);
        if($show)
        {
            header("Location:main_post.php?uid=$uid");
            $_SESSION['msg'] = "Submit Successfully";
        }
        else
        {
            header("Location:main_post.php?uid=$uid");
            $_SESSION['msg'] = "Submit Fail";
        }
    }
    elseif(isset($_GET['del']))
    {
        $del = $_GET['del'];
        $user->delete_main_post($del);
        header("Location:main_post.php?uid=$uid");
        $_SESSION['msg'] = "Post Delete Successfully";
    }
    elseif (isset($_GET['edit'])) 
    {
        if(isset($_POST['update']))
        {
            $edit = $_GET['edit'];
            extract($_POST);
            $edit_post = $user->edit_user_post($uid,$edit,$title,$fileToUpload,$description,$date,$time);
            if ($edit_post) 
            {
                header("Location:main_post.php?uid=$uid");
                $_SESSION['msg'] = "Post Update Successfully";
            }
        }
    }
    else
    {
        echo "";
    }
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
            if (isset($_SESSION['admin-name'])) 
            {
               echo $_SESSION['admin-name'];
            } 
            if(isset($_SESSION['user-name'])) 
            {
                echo $_SESSION['user-name'];
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

        <input type="hidden" name="date" value="<?php $date=date('d-m-Y', strtotime('now'-2));
echo $date; ?>">

                    <input type="hidden" name="time" value="<?php $time=date('h:i:s A', strtotime('now'-2));
echo $time; ?>">

        </form>
    </div>
    
    <div class="bottom-nav">
        <h3><a href='<?php 
                    if (isset($_GET['aid'])) 
                        {
                            echo "admin_menu.php";
                        }
                    else{
                        echo "home.php";
                        } ?>'>Go Back</a></h3>
    </div>
    
    <div class="admin-bar">
        <?php 
        if (isset($_GET['aid'])) 
        {
            $aid = $_GET['aid'];
            $user->show_main_post($aid);
        }
        if (isset($_GET['uid'])) 
        {
            $uid = $_GET['uid'];
            $user->show_user_post($uid);
        } ?>
    </div>

    <div class="bottom-nav">
        
    </div>
</div>
</body>
</html>