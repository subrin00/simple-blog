<?php 
include("function.php");
$user= new user;
session_start();
$admin_name=$_SESSION['admin-name'];
$admin_categore=$_SESSION['admin-cat'];
$admin_stat=$_SESSION['admin-stat'];
$email=$_SESSION['email'];
@$msg = $_SESSION['msg'];

if($admin_stat == "" || $admin_stat == 0)
{
	header("Location:index.php");
	$_SESSION['msg'] = "Your Are Not authorized";
}
elseif($admin_categore != "super-admin")
{
	header("Location:index.php");
	$_SESSION['msg'] = "Your Are Not authorized";
}
else
{
	echo "";
}


if(isset($_GET['edit']))
{ 
    if(isset($_POST['update']))
    {
        extract($_POST);
        $edit = $_GET['edit'];

        $edit_done = $user->edit_admin($edit,$id,$name,$email,$pass,$categore, $stat);
        if($edit_done)
        {
            header("Location:create_admin.php");
            $_SESSION['msg'] = "Admin Edit Successfully";
        }
    }
}
elseif(isset($_POST['submit']))
{
	extract($_POST);
	
	$create=$user->create_admin($id,$name,$email,$pass,$categore, $stat);
	if($create)
	{
		$_SESSION['msg'] = 'Admin Create Successfully';
        header("Location:create_admin.php");
	}
	else
	{
		$_SESSION['msg'] = 'Admin Create fail';
	}
}
elseif(isset($_GET['del']))
{
    $del = $_GET['del'];
    $user->delete_admin($del);
    header("Location:create_admin.php");
    $_SESSION['msg'] = "Admin Delete Successfully";
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
<title>Admin Menu</title>
<link rel="stylesheet" type="text/css" href="css/admin.css">
</head>

<body>
<div id="main-contain">
    <div class="heading">
        <h1>Create Admin</h1>
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
                        if (@$_SESSION['msg']) {
                            echo $_SESSION['msg']="";
                        }
                    }
             ?>    
        </h1>
    </div>

	<div id="from">
        <form action="" method="post">
        <?php if(isset($_GET['edit'])) {

            $edit = $_GET['edit'];

            $user->edit_admin_show($edit);
            
        }
        else { ?>
            <input class="id" type="text" name="id" placeholder="id">
        <br><br>
            <input class="name" type="text" name="name" placeholder="name">
        <br><br>
            <input class="email" type="email" name="email" placeholder="email">
        <br><br>
            <input class="pass" type="password" name="pass" placeholder="password">
        <br><br>
            <select class="categore" name="categore">
                <option value="super-admin" selected="selected">Super-Admin</option>
                <option value="admin">Admin</option>
                <option value="sub-admin">Sub-Admin</option>
            </select>
            
            <select class="stat" name="stat">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
            <br><br>
            <input class="submit" type="submit" name="submit" value="Create Admin">
            <?php } ?>
        </form>
    </div>
    <div class="bottom-nav">
        <h3><a href="admin_menu.php">Go Back</a></h3>
    </div>

    <div class="admin-bar">
    <table width="90%" border="1" style="margin:auto;">
      <tbody>
        <tr style="text-align:center; font-weight:bolder; font-size:18px;">
          <td>ID</td>
          <td>Name</td>
          <td>Category</td>
          <td>Status</td>
          <td>Edit</td>
          <td>Delete</td>
        </tr>
        <?php $user->show_admin(); ?>
      </tbody>
    </table>
    
    </div>
    <div class="bottom-nav">
        
    </div>
</div>

</div>
</body>
</html>