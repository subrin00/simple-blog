<?php
include("function.php");

$user= new user;

session_start();
if (isset($_SESSION['admin-stat'])) 
{
    if (isset($_GET['aid'])) 
    {
        $aid = $_GET['aid'];
        $id = $_GET['id'];
        if(isset($_POST['submit'])) 
        {
            extract($_POST);
            $user->admin_comment($aid,$id,$comment,$date,$time);
            header("Location:single.php?id=$id&aid=$aid");
        }

        if (isset($_GET['edit'])) 
        {
            $edit = $_GET['edit'];
            if (isset($_POST['submit'])) 
            {
                extract($_POST);                
                $update_admin_comment = $user->update_admin_comment($edit,$comment,$date,$time);
                if ($update_admin_comment) 
                {
                    header("Location:single.php?id=$id&aid=$aid");
                } 
            }                       
        }

        if(isset($_GET['del'])) 
        {
            $del = $_GET['del'];

            if(isset($_GET['aid'])) 
            {       
                $user->delete_comment($del);
                header("Location:single.php?id=$id&aid=$aid");
            }
        }
    }
}

elseif(isset($_SESSION['uid']))
{
    if(isset($_GET['uid'])) 
    {
        $uid = $_GET['uid'];
        $id = $_GET['id'];
        if (isset($_POST['submit'])) 
        {
            extract($_POST);
            $user->user_comment($uid,$id,$comment,$date,$time);
            header("Location:single.php?id=$id&uid=$uid");
        }

        if (isset($_GET['edit'])) 
        {
            $edit = $_GET['edit'];
            if (isset($_POST['submit'])) 
            {
                extract($_POST);
                $show_update_user_comment = $user->show_update_user_comment($edit,$comment,$date,$time);
                if($show_update_user_comment)
                {
                    header("Location:single.php?id=$id&uid=$uid");
                }
            }
        }

        if (isset($_GET['del'])) 
        {
            $del = $_GET['del'];
            if (isset($_GET['uid'])) 
            {        
                $user->delete_comment($del);
                header("Location:single.php?id=$id&uid=$uid");
            }
        }
    }
}
else
{
    header("Location:http://localhost/blogphp/");
    $_SESSION['msg'] = "You Are Not Autherise";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>notredame</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/media.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="js/jquery.cycle.all.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</head>

<body>

<div class="main-content-align">
    <div id="main-content">

    <!-------------header------------------>
    <div id="user">
    	<?php 
        if (isset($_SESSION['uemail'])) 
        {
            $uemail = $_SESSION['uemail'];
            $user->user_goto_post_page($uemail);
        }
        elseif(isset($_SESSION['email']))  
        {
            $email = $_SESSION['email'];
            $user->show_admins_menu($email);
        }    
        else
        {
            echo "";
        }
        ?>
        
        <div class="logout">
            <h5>
    			<?php 
                if(isset($_SESSION['admin-name']))
                {
                    echo "<a href='logout.php'>Logout</a>";
                }
                elseif (isset($_SESSION['user-name'])) 
                {
                    echo "<a href='logout.php'>Logout</a>";
                }
                else
                {
                    echo " ";
                } ?>
            </h5>
        </div>
        <div class="user-name">
            <h5>
    			<?php
                    if(isset($_SESSION['admin_name'])) 
                    {
                        $admin_name=$_SESSION['admin-name'];
                        echo $admin_name;
                    }                
                ?>
            </h5>
        </div>
        
    </div>
    <div id="header">
    	<div class="header-logo">
        </div>
        <div class="search-box">
        <form action="" method="post">
        <input class="search" type="search" name="googlesearch">
        <input type="submit" value="Search">
        </form>
        </div>
    </div>
    <!-------------end-header-------------->

    <!--------------main-nav---------------><!---->
        <nav>
        	<ul>
            	<li><a href="home.php">Home</a></li>
            	<li><a href="#">About NDC</a></li>
                <li><a href="#">Admissions</a></li>
                <li><a href="#">Academics</a></li>
                <li><a href="#">Adult</a></li>
                <li><a href="#">Resources & Services</a></li> 
                <li><a href="#">Athletics</a></li>
                <li><a href="#">Student Life</a></li> 
                <li><a href="#">Alumni</a></li>
                <li><a href="#">Support NDC</a></li>          
            </ul>    
        </nav>
    <!-------------end-main-nav------------->

    <!--------------slider------------------>
    <div id="slider">
    	<div class="slide-img">
            <ul>
                <?php $user->show_slider_image(); ?>
            </ul>
        </div>
        <div class="slide-text">
        <img src="image/arrao.png" style="position:absolute;   margin: 31px 0 0 -10px;">
        	<ul>
                <?php $user->show_slider_detail(); ?>
            </ul>
        </div>
    </div>
    <!--------------end-slider-------------->

    <!---------main-post-content------------>
    <div id="main-post-content">
    	<div class="side-bar-left">
            <h4 class="all-heading">Events Calendar</h4>
            <p class="all-para">
            <a href="#"><img src="image/bullet-red.gif" style="margin:0; padding:2px;">Senior Art Show Public Reception</a>
            <br>
            <a href="#"><img src="image/bullet-red.gif" style="margin:0; padding:2px;">Roller-Skating</a>
            <br>
            <a href="#"><img src="image/bullet-red.gif" style="margin:0; padding:2px;">Youth Cheer Clinic </a>
            </p>
            <h4 class="all-heading">Announcements</h4>
            <p class="all-para">
            <a href="#"><img src="image/bullet-red.gif" style="margin:0; padding:2px;">Notre Dame College to Enhance Entrepreneurship Program with New Grant Funding</a><br><br>
    <a href="#"><img src="image/bullet-red.gif" style="margin:0; padding:2px;">Notre Dame College Students from All Majors Display Fine Arts in Campus Show</a><br><br>
    <a href="#"><img src="image/bullet-red.gif" style="margin:0; padding:2px;">Notre Dame College Student, Faculty, Visiting Fellow Presentations Highlight Campus Week of Expertise</a><br><br>
    <a href="#"><img src="image/bullet-red.gif" style="margin:0; padding:2px;">Notre Dame College Education Majors Earn Job Interviews, Offers at Area Career Fair</a><br><br>
    <a href="#"><img src="image/bullet-red.gif" style="margin:0; padding:2px;">The Lenten Journey: Weekly Reflections</a><br>
            </p>
        </div>
        
        <div class="post-body">
        <h4 class="all-heading">What's Happening</h4>

        	<?php if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $user->show_single_post($id);
            }  
            ?>
            <div class="comments">
            <?php
                if (isset($_GET['id'])) 
                {
                    $id = $_GET['id'];
                    if (isset($_GET['uid'])) 
                    {
                        $xid = $_GET['uid'];
                    }
                    if (isset($_GET['aid'])) 
                    {
                        $xid = $_GET['aid'];
                    }
                    
                    $user->show_comments($id, $xid);
                }                
            ?>
            </div>
            <div class="comment_from">
                <h3>Leave A Comment</h3>
                <form action="" method="POST">
                    
                    <label class="form_lebel" for="comment">Comment:</label>
                    <?php if (isset($_GET['edit'])) 
                    {
                        $edit = $_GET['edit'];
                        $user->show_update_admin_comment($edit);
                    } else { ?>
                    <textarea id="comment" class="comment" rows="5" name="comment" placeholder="Your Comment"></textarea> <?php } ?>

                    <input type="hidden" name="date" value="<?php $date=date('d-m-Y', strtotime('now'-4));
echo $date; ?>">

                    <input type="hidden" name="time" value="<?php $time=date('h:i:s A', strtotime('now'-4));
echo $time; ?>">
                    <br>
                    <?php if (isset($_GET['edit'])) 
                    { 
                        echo "<button type='submit' class='comment_btn' name='submit'>Update</button>";
                    }
                    else
                    {
                        echo "<button type='submit' class='comment_btn' name='submit'>Submit</button>";
                    } ?>
                </form>
            </div>
        </div>
    
        <div class="side-bar-right">
         <h4 class="all-heading">Admissions</h4>
         <p class="all-para"><a href="#"><img src="image/bullet-red.gif" style="margin:0; padding:2px;">Apply</a></p>
         <p class="all-para"><a href="#"><img src="image/bullet-red.gif" style="margin:0; padding:2px;">Online Programs</a></p>
         <p class="all-para"><a href="#"><img src="image/bullet-red.gif" style="margin:0; padding:2px;">My NDC</a></p>
         <p class="all-para"><a href="#"><img src="image/bullet-red.gif" style="margin:0; padding:2px;">Visit Us</a></p>
         <p class="all-para"><a href="#"><img src="image/bullet-red.gif" style="margin:0; padding:2px;">Financial Aid</a></p>
         <p class="all-para"><a href="#"><img src="image/bullet-red.gif" style="margin:0; padding:2px;">CASHNet - Online Payment System</a></p>
         <p class="all-para"><a href="#"><img src="image/bullet-red.gif" style="margin:0; padding:2px;">Transcript Request</a></p>
        </div>
        </div>
    
    <!------end-main-post-content----------->



    </div>
    <!------------footer-------------------->
    <footer>
        <div class="copyright">
        <p>Copyright © 2010 by Notre Dame College. All rights reserved. | Privacy Policy | Site Map | Web Master | Contact Us |
    4545 College Road South Euclid, Ohio 44121-4293 Toll Free: 1.877.NDC.OHIO (1.877.632.6446)</p>
        </div>
        <div class="social-icon">
            <div class="icon">
                <a href="#"><img src="image/facebook.gif"></a>
                <a href="#"><img src="image/twitter.gif"></a>
                <a href="#"><img src="image/youtube.gif"></a>
                <a href="#"><img src="image/flickr.gif"></a>
            </div>
        </div>
    </footer>
    </div>
</div>
<!---------end-footer-------------->

</body>
</html>