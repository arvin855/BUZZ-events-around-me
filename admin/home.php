<?php 
require 'functions/functions.php';
session_start();
// Check whether user is logged on or not
if (!isset($_SESSION['user_id'])) {
    header("location:../index.html");
}
$temp = $_SESSION['user_id'];
session_destroy();
session_start();
$_SESSION['user_id'] = $temp;
ob_start(); 
// Establish Database Connection
$conn = connect();
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<title>BUZZ  | HOME</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<link rel="shortcut icon" type="image/png" href="images/icon.png">
		<link rel="stylesheet" herf="css/main.css" >
		<link rel="stylesheet" href="css/style.css">
		
		<style>
		.logo img
		{
			width: 100px;
			height: auto;
			float: left;
			margin: 10px;
		}
		.post,
		.createpost {
			background-color: white;
			box-shadow: 0 0 5px #4267b2;
			margin: auto;
			width: 650px;
			padding: 10px 16px;
			overflow: auto;
		}
		i:hover{
			color:blue;
		}
		li a:hover{
			color: red;
		}
		.none{
			
			background-color: #99ccff;
			background-image: url("images/b11.jpg");
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: cover;
		
		}
		</style>

	</head>
	<body class="none">
        
    <!-- start of  navigation bar-->
	<nav class="navbar navbar-default navbar-light  navbar-fixed-top" style="background-color: #f7d9a0;">
        <div class="navbar-header">
        <div class="logo">
                <a href="home.php"><img src="images/Buzz-Logo.png" alt="buzz"></a>
                </div>
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav" >
                <li class="active"><a href="home.php"><i class="fas fa-home fa-lg"> Home</i></a></li>
                <li><a href="eventpost.php"><i class="fas fa-camera-retro fa-lg"> Post</i></a></li>
                <li class="dropedown"><a href="#" class="dropdown-toggle"  data-toggle="dropdown"><i class="fas fa-address-book fa-lg"> Profile <b class="caret"></b></i></a>
                <ul class="dropdown-menu" id="dropdown-menu" style="background-color: #f3f3f3;">
                  <li>  <a class="dropdown-item" href="profile.php">View Profile</a></li>
                   <li> <a class="dropdown-item" href="edit_profile.php">Edit Profile</a></li>
                </ul>
			</li>
			<li ><a href="dashboard.php"><i class="fas fa-cog fa-lg"> manage users/posts</i></a></li>
            </ul>
            
            <ul class="nav navbar-nav" style="float: right">
                <li ><a href="logout.php" ><i class="fas fa-power-off fa-lg"> Logout</i></a></li>
            </ul>
        </div>
    </nav>
<!-- end of navigation bar -->

<!-- news feed -->
		<div class="container">
			<h1>Event Feeds</h1>
			<?php
				 $sql = "SELECT post_type, posts.post_caption, posts.post_time, posts.paddress, users.fname,
				 users.lname, users.user_id, users.gender, posts.post_id, users.email
				FROM posts
				JOIN users
				ON posts.post_by = users.user_id and posts.post_type = 'post'
				WHERE users.user_id = {$_SESSION['user_id']}
				UNION
                SELECT post_type, posts.post_caption, posts.post_time, posts.paddress, users.fname,
                        users.lname, users.user_id, users.gender, posts.post_id, users.email
                FROM posts
                JOIN users
                ON posts.post_by = users.user_id and posts.post_type = 'post'
				ORDER BY post_time DESC";
		$query = mysqli_query($conn, $sql);
		if(!$query){
			echo mysqli_error($conn);
		}
		if(mysqli_num_rows($query) == 0){
			echo '<div class="post">';
			echo 'There are no posts yet to show.';
			echo '</div>';
		}
		else{
			$width = '40px'; // Profile Image Dimensions
			$height = '40px';
			while($row = mysqli_fetch_assoc($query)){
					include 'includes/post.php';
					echo '<br>';
				}
			}

			?>
			<br><br><br>
		
		
		</div>
			
<!-- end of news feed -->
		
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->


	</body>
</html>
