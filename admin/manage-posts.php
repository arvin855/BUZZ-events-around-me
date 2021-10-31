<?php
session_start();
//error_reporting(0);
include('includes/config.php');


if(isset($_GET['del']))
		  {
		          mysql_query("delete from posts where post_id = '".$_GET['id']."'");
				  echo '<script>'.'alert("Post successfully Deleted");'.'</script>';
				  header("refresh:0; url=manage-posts.php");
		  }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin | Manage Posts
        </title>
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
		.bg{
				background: url(images/winter.jpg);
				
				background-repeat: no-repeat;
				background-size: cover;
				background-position: center; 
			}
			#sample-table-1{
				
			}
		#app{
			border:1px solid black;
		}
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
		.tg:hover{
			color:black;
        }
        i:hover{
			color:blue;
		}
		li a:hover{
			color: red;
		}
		.none{
			background-color: #266D69;
		}
		</style>
	</head>
	<body class="bg">
	
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
                <li ><a href="home.php"><i class="fas fa-home fa-lg"> Home</i></a></li>
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
	<br>
	<br>
	<br>
	
		<div id="app">		

			<div class="app-content">
				
						
						
				<!-- end: TOP NAVBAR -->
				
									
					
						<!-- start: PAGE TITLE -->
						
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						
						<div class="container-fluid container-fullw bg-white">
						

									<div class="row">
								<div class="col-md-12">
									<h5 class="over-title margin-bottom-15"><b><i style="font-weight: bold;" class="far fa-images fa-lg"> Manage Posts</i></h5></b>
									
									<table class="table table-hover" id="sample-table-1">
									<thead>
											<tr>
												<th class="center">#</th>
                                                <th>Post_id</th>
                                                <th>Post type</th>
												<th>Post_By</th>
												<th>Post Date </th>
												<th>No Of Tickets Available</th>
												<th>Price</th>
												<th>Action</th>
												
											</tr>
										</thead>
										<tbody>
<?php
$postsql = mysql_query("select posts.post_id, posts.post_time, posts.pticket,
        posts.tprice, users.fname,
        users.user_id, users.gender, 
       posts.post_type
        FROM posts
        JOIN users
        ON users.user_id = posts.post_by");
       

$cnt=1;
while($row=mysql_fetch_array($postsql))
{
?>

											<tr>
											<b>
												<td style="color:#003366;font-weight: bold;" class="center"><?php echo $cnt;?>.</td>
                                                <td style="color:#003366;font-weight: bold;"class="hidden-xs"><?php echo $row['post_id'];?></td>
                                                <td style="color:#003366;font-weight: bold;"><?php echo $row['post_type'];?></td>
												<td style="color:#003366;font-weight: bold;"><?php echo $row['fname'];?></td>
												<td style="color:#003366;font-weight: bold;"><?php echo $row['post_time'];?></td>
												<td style="color:#003366;font-weight: bold;"><?php echo $row['pticket'];?></td>
												<td style="color:#003366;font-weight: bold;"><?php echo $row['tprice'];?></td>
												
												<td >
												<div class="visible-md visible-lg hidden-sm hidden-xs">
							
								<!--<a href="edit-post.php?id=<?php echo $row['post_id'];?>" class="btn btn-transparent btn-xs"><i class="fas fa-pencil-alt fa-lg" style=""></i></a>-->
	<a href="manage-posts.php?id=<?php echo $row['post_id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i style="color:red;" class="fas fa-trash-alt fa-lg"> Delete</i></a> 
												</div>
												<div class="visible-xs visible-sm hidden-md hidden-lg">
													<div class="btn-group" dropdown is-open="status.isopen">
														<button type="button" class="btn btn-primary btn-o btn-sm dropdown-toggle" dropdown-toggle>
															<i class="fa fa-cog"></i>&nbsp;<span class="caret"></span>
														</button>
													</div>
												</div></td>
												</td>
											</tr>
											
											<?php 
$cnt=$cnt+1;
											 }?>
											
											
										</tbody>
									</table>
								</div>
							</div>
								</div>
							
						
						<!-- end: BASIC EXAMPLE -->
						<!-- end: SELECT BOXES -->
						
					</div>
				</div>
			
			<!-- start: FOOTER -->
	
			<!-- end: FOOTER -->
		
			<!-- start: SETTINGS -->
	
			
			<!-- end: SETTINGS -->
		
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
