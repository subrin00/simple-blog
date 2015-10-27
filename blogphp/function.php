<?php 
include "db.php";

class user
{
	public $db;
		
	public function __construct()
	{
		$this->db = new MySQLi(db_host,db_user,db_password,db_name);
		
		if(mysqli_connect_errno())
		{
			echo 'Database connect Fail';
			exit;
		}
	}
		
	//user sign up
	public function user_signup($name,$email,$pass)
	{
		$sql="select * from mainpost";
		$sql = "insert into user_sign_up values('','$name','$email','$pass')";
		$result = $this->db->query($sql);
		return true;
	}

	public function user_goto_post_page($uemail)
	{
		$sql="SELECT * FROM `user_sign_up` WHERE email = '$uemail'";
		$result= $this->db->query($sql);
		$data=$result->fetch_array();
		echo "<div class='admin-option'><h5><a href='main_post.php?uid=$data[id]' style='color:#fff;'>User Post</a></h5></div>";
	}
	
 	//user sign in
	public function user_sign_in($email,$pass)
	{
		$sql="SELECT * FROM `user_sign_up` WHERE email='$email' AND password='$pass'";
		$result= $this->db->query($sql);
		$data=$result->fetch_array();
		$row=$result->num_rows;
		if($row == 1)
		{
			$_SESSION['uid']=$data['id'];
			$_SESSION['user-name']=$data['name'];
			$_SESSION['uemail']=$data['email'];
		}
	}
	
	//Main Post Upload
	public function mainpost($aid,$title,$target_file,$des,$date,$time)
	{
		$target_dir = "image/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
		$sql="INSERT INTO `mainpost` VALUES('','$title','$target_file','$des','$aid','','$date','$time')";
		$result=$this->db->query($sql);
		return true;
	}

	public function user_post($uid,$title,$target_file,$des,$date,$time)
	{
		$target_dir = "image/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
		$sql="INSERT INTO `mainpost` VALUES('','$title','$target_file','$des','','$uid','$date','$time')";
		$result=$this->db->query($sql);
		return true;
	}

	//Main Post Content
	public function shomainpost()
	{
		$sql="SELECT * FROM `mainpost`";
		$result = $this->db->query($sql);
		while($data=$result->fetch_array())
			{
				$sqla="SELECT * FROM `create_admin` WHERE id='$data[aid]'";
				$resulta = $this->db->query($sqla);
				$dataa=$resulta->fetch_array();

				$sqlu="SELECT * FROM `user_sign_up` WHERE id='$data[uid]'";
				$resultu = $this->db->query($sqlu);
				$datau=$resultu->fetch_array();

				echo "<div class='post-news'>";
				echo "<h3><a href='single.php?id=$data[id]&";
									if (isset($_SESSION['uid'])) 
            						{
                						$uid = $_SESSION['uid'];
                						echo "uid=$uid";
                					}
                					if (isset($_SESSION['aid'])) 
            						{
                						$aid = $_SESSION['aid'];
                						echo "aid=$aid";
                					}
                echo "'><span>$data[title]</span></a>";
				echo "<span class='post_auth'>by: "; 
								if($dataa['name'])
								{
									echo 'Admin';
								}
								else
								{
									echo $datau['name'];
								}   
				echo ", on $data[date]</span></h3>";
				echo "<a href='single.php?id=$data[id]&";
									if (isset($_SESSION['uid'])) 
            						{
                						$uid = $_SESSION['uid'];
                						echo "uid=$uid";
                					}
                					if (isset($_SESSION['aid'])) 
            						{
                						$aid = $_SESSION['aid'];
                						echo "aid=$aid";
                					}
                echo "'><img src='$data[image]'></a>";
				echo "<p>$data[description]</p>";
				echo "<div class='read-more'><a href='single.php?id=$data[id]&";
									if (isset($_SESSION['uid'])) 
            						{
                						$uid = $_SESSION['uid'];
                						echo "uid=$uid";
                					}
                					if (isset($_SESSION['aid'])) 
            						{
                						$aid = $_SESSION['aid'];
                						echo "aid=$aid";
                					}
                echo "'>Read More</a></div>";
				echo "</div>";
			}
	}

	public function show_single_post($id)
	{
		$sql="SELECT * FROM `mainpost` WHERE id ='$id'";
		$result = $this->db->query($sql);
		$data=$result->fetch_array();

		$sqla="SELECT * FROM `create_admin` WHERE id='$data[aid]'";
		$resulta = $this->db->query($sqla);
		$dataa=$resulta->fetch_array();

		$sqlu="SELECT * FROM `user_sign_up` WHERE id='$data[uid]'";
		$resultu = $this->db->query($sqlu);
		$datau=$resultu->fetch_array();

		echo "<h3 class='single_post_head'><span class='single_post_title'>$data[title]</span>";
		echo "<span class='single_post_date'>by: "; 
								if($dataa['name'])
								{
									echo 'Admin';
								}
								else
								{
									echo $datau['name'];
								}   
		echo ", on $data[date], $data[time]</span></h3>";
		echo "<img src='$data[image]' width='100%'>";
		echo "<p class='single_post_para'>$data[description]</p>";
		
	}
	
	public function show_main_post($aid)
	{
		$sql="SELECT * FROM `mainpost` WHERE aid='$aid' ORDER BY id ASC";
		$result = $this->db->query($sql);
		while($data=$result->fetch_array())
			{
				echo "<div class='post-news'>";
				echo "<h3><a href='#'>$data[title]</a></h3>";
				echo "<img src='"; if($data["image"] == "image/")
	        						{
	        							echo "image/sample.jpg";
	        						}
	        						else
	        						{
	        							echo $data["image"];
	        						} echo "'>";
				echo "<p>$data[description]</p>";
				echo "<p class='edit'><a href='main_post.php?aid=$aid&edit=$data[id]'>Edit</a></p>";
				echo "<p class='edit'><a href='main_post.php?aid=$aid&del=$data[id]'>Detele</a></p>";
				echo "</div>";
			}
	}

	public function show_user_post($uid)
	{
		$sql="SELECT * FROM `mainpost` WHERE uid='$uid' ORDER BY id ASC";
		$result = $this->db->query($sql);
		while($data=$result->fetch_array())
			{
				echo "<div class='post-news'>";
				echo "<h3><a href='#'>$data[title]</a></h3>";
				echo "<img src='"; if($data["image"] == "image/")
	        						{
	        							echo "image/sample.jpg";
	        						}
	        						else
	        						{
	        							echo $data["image"];
	        						} echo "'>";
				echo "<p>$data[description]</p>";
				echo "<p class='edit'><a href='main_post.php?uid=$uid&edit=$data[id]'>Edit</a></p>";
				echo "<p class='edit'><a href='main_post.php?uid=$uid&del=$data[id]'>Detele</a></p>";
				echo "</div>";
			}
	}
		
	//Create Admin
	public function create_admin($serial_id,$name,$email,$pass,$cat,$stat)
	{
		$sql= "insert into create_admin values('','$serial_id','$name','$email','$pass','$cat','$stat')";
		$result = $this->db->query($sql);
		return true;
	}
	
	//sign in admin
	public function admin_signin($email,$pass)
	{
		$sql="select * from create_admin where email='$email' and password='$pass'";
		$result = $this->db->query($sql);
		$data = $result->fetch_array();
		$row= $result->num_rows;
		if($row == 1)
		{
			$_SESSION['admin_signin']=true;
			$_SESSION['aid']=$data['id'];
			$_SESSION['admin-name']=$data['name'];
			$_SESSION['admin-cat']=$data['categore'];
			$_SESSION['admin-stat']=$data['stat'];
			$_SESSION['email']=$data['email'];
			$_SESSION['password']=$data['password'];
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//logOut function
	public function logout()
	{
		session_start();
		if(session_destroy())
		{
			header("Location:index.php");
		}
	}
	
	//show admin list
	public function show_admin()
	{
		$sql= "select * from create_admin";
		$result=$this->db->query($sql);
		while($data=$result->fetch_array())
		{
			echo "<tr>";
			echo "<td>$data[serial_id]</td>";
			echo "<td>$data[name]</td>";
			echo "<td>$data[categore]</td>";
			echo "<td>$data[stat]</td>";
			echo "<td><a href='create_admin.php?edit=$data[id]'>edit</a></td>";
			echo "<td><a href='create_admin.php?del=$data[id]'>delete</a></td>";
			echo "</tr>";
		}
	}
	
	//Create Slider
	public function create_slider($title,$des,$file_upload)
	{
		$target_dir = "image/";
		$file_upload = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($file_upload,PATHINFO_EXTENSION);
		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $file_upload)) {
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
		$sql="insert into slider values('','$title','$des','$file_upload')";
		$result= $this->db->query($sql);
		return true;
	}
	
	//Show slider Images
	public function show_slider_image()
	{
		$sql="select * from slider";
		$result=$this->db->query($sql);
		while($data=$result->fetch_array())
		{
			echo "<li><img src='$data[image]'></li>";
		}
	}
	
	//Show Slider Title And Description
	public function show_slider_detail()
	{
		$sql="select * from slider";
		$result=$this->db->query($sql);
		while($data=$result->fetch_array())
		{
			echo "<li><h3>$data[title]</h3><p>$data[description]</p></li>";
		}
	}

	public function show_slider()
	{
		$sql="select * from slider";
		$result=$this->db->query($sql);
		while($data=$result->fetch_array())
		{
			echo "<tr>
                <td>
                    $data[title]
                </td>
                <td><img style='width:200px; height:100px; margin-bottom:20px;' src='"; 
                					if($data["image"] == "image/")
	        						{
	        							echo "image/sample.jpg";
	        						}
	        						else
	        						{
	        							echo $data["image"];
	        						} echo "'</td>
                <td><a href='slider.php?edit=$data[id]'>Edit</a> | <a href='slider.php?del=$data[id]'>Delete</a></td>
            </tr>";
		}
	}
	
	//show admin menu
	public function show_admins_menu($email)
	{
		$sql="select * from create_admin where email='$email'";
		$result= $this->db->query($sql);
		$data = $result->fetch_array();
		$_SESSION['email']=$data['email'];
		
			if ($data['categore'] == 'super-admin')
			{
			    echo "<div class='admin-option'><h5><a href='admin_menu.php' style='color:#fff;'>Super-Admin</a></h5></div>";
			}
			elseif ($data['categore'] == 'admin')
			{
				echo "<div class='admin-option'><h5><a href='admin_menu.php' style='color:#fff;'>Admin</a></h5></div>";
			}
			elseif ($data['categore'] == 'sub-admin')
			{
				echo "<div class='admin-option'><h5><a href='admin_menu.php' style='color:#fff;'>Sub-Admin</a></h5></div>";
			}
			else
			{
				echo " ";
			}
	}
	
	//admin menu privacy
	public function admin_menu_privecy($email)
	{
		$sql="SELECT * FROM `create_admin` WHERE email='$email'";
		$result=$this->db->query($sql);
		$data=$result->fetch_array();
		$_SESSION['email']=$data['email'];

		if($data['categore'] == 'super-admin')
		{
			echo "<h3><a href='create_admin.php'>Create Admin</a></h3>
			<h3><a href='main_post.php?aid=$data[id]'>Main Post</a></h3>
			<h3><a href='slider.php'>Slider Post</a></h3>
			<h3><a href='menu.php'>Menu Post</a></h3>";
		}
		elseif($data['categore'] == 'admin')
		{
			echo "<h3><a href='main_post.php?aid=$data[id]'>Main Post</a></h3>
			<h3><a href='slider.php'>Slider Post</a></h3>
			<h3><a href='menu.php'>Menu Post</a></h3>
";
		}
		elseif($data['categore'] == 'sub-admin')
		{
			echo "<h3><a href='main_post.php?aid=$data[id]'>Main Post</a></h3>";
		}
		else
		{
			echo " ";
		}
	}


	//------------comment----------------
	public function admin_comment($aid,$id,$comment,$date,$time)
	{
		$sql = "INSERT INTO `comment` VALUES('','$id', '$aid','','$comment','$date','$time')";
		$result = $this->db->query($sql);
		return true;
	}

	public function user_comment($uid,$id,$comment,$date,$time)
	{
		$sql = "INSERT INTO `comment` VALUES('', '$id', '', '$uid', '$comment', '$date', '$time')";
		$result = $this->db->query($sql);
		return true;
	}

	public function show_comments($id,$xid)
	{
		$sql = "SELECT * FROM `comment` WHERE pid = '$id'";
		$result = $this->db->query($sql);
		while($data = $result->fetch_array())
		{
			$sqlu = "SELECT * FROM `user_sign_up` WHERE id = $data[uid]";
			$resultu = $this->db->query($sqlu);
		 	$datau = $resultu->fetch_array();

		 	echo "<div class='comment_body'>";
			echo "<img src='image/user.png' width='20px'><h4>by: "; 
							if($datau['name'])
							{
								echo $datau['name'];
							}
							else
							{
								echo "Admin";
							}
			echo " <span class='comment_time'>on $data[date], $data[time]</span></h4>
				  <p class='comment_para'>$data[comment]</p>";
				  if($xid == $data['uid'])
				  	{
				  		if (isset($_SESSION['uid']))
						{
							echo "<a href='single.php?id=$id&uid=$xid&edit=$data[id]'>Edit</a>/<a href='single.php?id=$id&uid=$xid&del=$data[id]'>Del</a>";
						}
						else
						{
							session_destroy();
						}
					}
					elseif ($xid == $data['aid']) 
					{
						if (isset($_SESSION['aid']))
						{
							echo "<a href='single.php?id=$id&aid=$xid&edit=$data[id]'>Edit</a>/<a href='single.php?id=$id&aid=$xid&del=$data[id]'>Del</a>";
						}						
						else
						{
							session_destroy();
						}						
					}
					else
					{
						echo "";
					}
			echo "</div>";
		}
	}

	public function update_admin_comment($edit,$comment,$date,$time)
	{
		$sql = "UPDATE `comment` SET comment = '$comment', date='$date', time = '$time' WHERE id = '$edit'";
		$result = $this->db->query($sql);
		return true;
	}

	public function show_update_admin_comment($edit)
	{
		$sql = "SELECT * FROM `comment` WHERE id='$edit'";
		$result = $this->db->query($sql);
		$data = $result->fetch_array();
		echo "<textarea id='comment' class='comment' rows='5' name='comment'>$data[comment]</textarea>";
	}

	public function show_update_user_comment($edit,$comment,$date,$time)
	{
		$sql = "UPDATE `comment` SET comment = '$comment', date='$date', time = '$time' WHERE id = '$edit'";
		$result = $this->db->query($sql);
		return true;
	}

	public function delete_comment($del)
	{
		$sql = "DELETE FROM `comment` WHERE id = '$del'";
		$result = $this->db->query($sql);
		return true;
	}
	// --------------end comment----------
	
	 
	//--------------Edit All Items --------------------
	
	// Admin Edit
	public function edit_admin_show($edit)
	{
		$sql="SELECT * FROM `create_admin` WHERE id = '$edit'";
		$result=$this->db->query($sql);
		$data= $result->fetch_array();
		echo "<input class='id' type='text' name='id' value='$data[serial_id]'>
        <br><br>
            <input class='name' type='text' name='name' value='$data[name]'>
        <br><br>
            <input class='email' type='email' name='email' value='$data[email]'>
        <br><br>
            <input class='pass' type='password' name='pass' value='$data[password]'>
        <br><br>
            <select class='categore' name='categore'>
                <option value='$data[categore]' selected='selected'>$data[categore]</option>
                <option value='super-admin'>Super-Admin</option>
                <option value='admin'>Admin</option>
                <option value='sub-admin'>Sub-Admin</option>
            </select>
            
            <select class='stat' name='stat'>
            	<option value='$data[stat]'>$data[stat]</option>
                <option value='1'>Active</option>
                <option value='0'>Inactive</option>
            </select>
            <br><br>
            <button type='submit' class='submit' name='update' >Update Admin</button>";
	}
	public function edit_admin($edit,$id,$name,$email,$pass,$categore, $stat)
	{
		$sql_edit="UPDATE `create_admin` SET serial_id='$id', name='$name', email='$email', password='$pass', categore='$categore', stat='$stat' WHERE id='$edit'";
		$result_edit=$this->db->query($sql_edit);
		return true;

	}
	
	//Main Post Update

	public function show_edit_main_post($edit)
	{
		$sql = "SELECT * FROM `mainpost` WHERE id = '$edit'";
		$result = $this->db->query($sql);
		$data = $result->fetch_array();
		echo "<input class='title' type='text' name='title' value='$data[title]'>
	        <br><br>
	        <input class='img' type='file' name='fileToUpload' value=''>
	        <br><br>
	        <input class='des' type='text' name='description' value='$data[description]'>
	        <br><br>
	        <button type='submit' class='submit' name='update' >Update Admin</button>";
	}

	public function edit_main_post($aid,$id,$title,$target_file,$des,$date,$time)
	{
		$target_dir = "image/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if file already exists
		
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
		
		$sql="SELECT * FROM `mainpost`";
		$result=$this->db->query($sql);
		$data=$result->fetch_array();
		
		$sql_udpate="UPDATE mainpost SET title='$title',image='$target_file',description='$des', aid='$aid', date='$date', time='$time' WHERE id='$id'";
		$resultk =$this->db->query($sql_udpate);
		return true;
	}

	public function edit_user_post($uid,$id,$title,$target_file,$des,$date,$time)
	{
		$target_dir = "image/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if file already exists
		
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
		
		$sql="SELECT * FROM `mainpost`";
		$result=$this->db->query($sql);
		$data=$result->fetch_array();
		
		$sql_udpate="UPDATE mainpost SET title='$title',image='$target_file',description='$des', uid='$uid', date='$date', time='$time' WHERE id='$id'";
		$resultk =$this->db->query($sql_udpate);
		return true;
	}

	// Slider Edit
	public function show_edit_slider($edit)
	{
		$sql = "SELECT * FROM `slider` WHERE id = '$edit'";
		$result = $this->db->query($sql);
		$data = $result->fetch_array();

		echo "<input class='title' type='text' name='title' value='$data[title]'>
        <br><br>
        <input class='des' type='text' name='description' value='$data[description]'>
        <br><br>
        <input class='img' type='file' name='fileToUpload'>
        <br><br>
        <button type='submit' class='submit' name='update' >Update Slider</button>";
	}
	public function update_slider($edit,$title,$des,$file_upload)
	{
		$target_dir = "image/";
		$file_upload = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($file_upload,PATHINFO_EXTENSION);
		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $file_upload)) {
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
		$sql="UPDATE `slider` SET title = '$title', description = '$des', image = '$file_upload' WHERE id = '$edit'";
		$result= $this->db->query($sql);
		return true;
	}
	
	// Update Slider
	public function edit_slider($id, $title,$target_file,$des)
	{
		$target_dir = "image/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
		
		$sql="select * from mainpost";
		$result=$this->db->query($sql);
		$data=$result->fetch_array();
		
		$sql_udpate="UPDATE slider SET title='$title',image='$target_file',description='$des' WHERE id='$id'";
		$resultk =$this->db->query($sql_udpate);
		return true;
	}

	//delete main post
	
	public function delete_main_post($del)
	{
		$sql="DELETE FROM `mainpost` WHERE id='$del'";
		$result=$this->db->query($sql);
		return true;
	}
	public function delete_admin($del)
	{
		$sqlDelete="DELETE FROM `create_admin` WHERE id='$del'";
		$result=$this->db->query($sqlDelete);
		return true;
	}
	public function delete_slider($id)
	{
		$sqlDelete="DELETE FROM slider WHERE id='$id'";
		$result=$this->db->query($sqlDelete);
		return true;
	}


}

?>