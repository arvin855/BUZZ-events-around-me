<?php
session_start();
//error_reporting(0);
include('includes/config.php');
$did=$_GET['id'];
if(isset($_POST['submit']))
{
	
$uname=$_POST['name'];
$cat=$_POST['cat'];
//$cat=$_POST['cat'];
$status=$_POST['status'];
$sql=mysql_query("Update users set fname='$uname',catagory='$cat',user_status='$status' where user_id='$did'");
if($sql)
{
echo "<script>alert('user Details updated Successfully');</script>";

}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin | Edit technician Details</title>
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
				background: url(images/notebook2.jpg);
				background-repeat: no-repeat;
				background-size: cover;
				background-position: center; 
			}
			.bg3{
				margin:20px;
				width:900px;
			}
			i:hover{
			color:blue;
		}
	#app{
			border:1px solid black;
			box-shadow: 0 0 5px #4267b2;
			width:700px;
			margin-left:300px;
			margin-top:40px;
			-webkit-box-shadow: -1px 4px 26px 11px rgba(0,0,0,0.75);
			-moz-box-shadow: -1px 4px 26px 11px rgba(0,0,0,0.75);
			box-shadow: -1px 4px 26px 11px rgba(0,0,0,0.75);
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
	li a:hover{
		color: red;
	}
	.none{
		background-color: #266D69;
	}
	</style>

	</head>
	<body class="bg">
	<nav class="navbar navbar-default navbar-light  navbar-fixed-top" style="background-color: #f7d9a0; opacity: 0.8;">
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
			<li ><a href="manage-users.php"><i class="fas fa-cog fa-lg"> manage users</i></a></li>
            </ul>
            
            <ul class="nav navbar-nav" style="float: right">
                <li ><a href="logout.php" ><i class="fas fa-power-off fa-lg"> Logout</i></a></li>
            </ul>
        </div>
	</nav>
<br><br><br>
		<div id="app">		

			<div class="app-content">
				
						
						<!-- start: MENU TOGGLER FOR MOBILE DEVICES -->
					
				<!-- end: TOP NAVBAR -->
				
						<!-- start: PAGE TITLE -->
						
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white bg3">
							<div class="row">
								<div class="col-md-12">
									
									<div class="row margin-top-30">
										<div class="col-lg-8 col-md-12">
											<div class="panel panel-white">
												<div class="panel-heading">
													<h5 class="panel-title">edit user</h5>
												</div>
												<div class="panel-body">
									<?php $sql=mysql_query("select * from users where user_id='$did'");
while($data=mysql_fetch_array($sql))
{
?>
													<form role="form" name="adddoc" method="post" onSubmit="return valid();">

<div class="form-group">
															<label for="username">
																 user Name
															</label>
	<input type="text" name="name" readonly class="form-control" value="<?php echo htmlentities($data['fname']);?>" >
														</div>
	

<div class="form-group">
									<label for="fess">
																user catagory
															</label>
															<select name="cat" class="form-control" required="required">
												<option value="">select status</option>
												<option value="user">user</option>
												<option value="admin">admin</option>	
</select>								
												</div>



<div class="form-group">
									<label for="fess">
																user status 
															</label>
												<select name="status" class="form-control" required="required">
												<option value="">select status</option>
												<option value="active">active</option>
												<option value="deactive">deactive</option>
											<!-- <option value="delete">delete</option> -->
										</select>
													</div>
	



														
														<?php } ?>
														
														
														<button type="submit" name="submit" class="btn btn-o btn-primary">
															Update
														</button>
													</form>
												</div>
											</div>
										</div>
											
											</div>
										</div>
									
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- end: BASIC EXAMPLE -->
			
					
					
						
						
					
						<!-- end: SELECT BOXES -->
						
					
				
			</div>
			<!-- start: FOOTER -->
	
			<!-- end: FOOTER -->
		
			<!-- start: SETTINGS -->
	
			
			<!-- end: SETTINGS -->
		</div>
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
