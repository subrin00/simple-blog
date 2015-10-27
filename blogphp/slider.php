<?php
include("function.php");
$user=new user;
error_reporting(0); 

session_start();
$admin_name=$_SESSION['admin-name'];
$admin_categore=$_SESSION['admin-cat'];
$admin_stat=$_SESSION['admin-stat'];
$email=$_SESSION['email'];
$msg = $_SESSION['msg'];

if($admin_stat == 0)
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

if(isset($_POST['submit']))
{
	extract($_POST);
	
	$slider=$user->create_slider($title,$description,$fileToUpload);
	
	if($slider)
	{
		$msg= 'Slider Create Successfully';
	}
	else
	{
		$msg='Slider Create Fail';
	}
}
elseif (isset($_GET['del']))
{
    $del = $_GET['del'];
    $user->delete_slider($del);
    header("Location:slider.php");
    $_SESSION['msg']= "Slider Delete Successfully";
}
elseif (isset($_GET['edit'])) 
{
    if (isset($_POST['update'])) 
    {
        $edit = $_GET['edit'];
        extract($_POST);
        $slider_edit = $user->update_slider($edit,$title,$description,$fileToUpload);
        if ($slider_edit) 
        {
            header("Location:slider.php");
            $_SESSION['msg']= "Slider Update Successfully";
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
<title>Create Slider</title>
<link rel="stylesheet" type="text/css" href="css/admin.css">
</head>

<body>
<div id="main-contain">
    <div class="heading">
        <h1>Create Slider</h1>
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
        <?php if (isset($_GET['edit'])) 
        {
            $edit = $_GET['edit'];
            $user->show_edit_slider($edit);
        }else{ ?>
        <input class="title" type="text" name="title" placeholder="Exter Your title">
        <br><br>
        <input class="des" type="text" name="description" placeholder="Enter Your Description">
        <br><br>
        <input class="img" type="file" name="fileToUpload">
        <br><br>
        <input class="submit" type="submit" name="submit">
        <?php } ?>
        </form>
    </div>

    <div class="bottom-nav">
        <h3><a href="admin_menu.php">Go Back</a></h3>
    </div>

    <table width="90%">
        <tbody>
            <tr style="font-size:20px;">
                <td><strong>Title</strong></td>
                <td><strong>Picture</strong></td>
            </tr>
        </tbody>
        <?php $user->show_slider(); ?>
    </table>

</div>
</body>
</html>