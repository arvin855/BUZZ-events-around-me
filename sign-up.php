<?php
	include_once('includes/config.php');
	if(isset($_POST['submit']))
	{
	$fname=$_POST['full_name'];
	$lname=$_POST['last_name'];
	$address=$_POST['address'];
	$city=$_POST['city'];
	$gender=$_POST['gender'];
	$email=$_POST['email'];
	$password=($_POST['password']);
	$query=mysql_query("insert into users(fname,lname,address,city,gender,email,password) values('$fname','$lname','$address','$city','$gender','$email','$password')");
	if($query)
	{
		echo '<script>'.'alert("Successfully Registered. You can login now");'.'</script>';
		header("refresh:0;url=login.php");
		
	}
	else
	 	echo '<script>'.'alert("unsuccessful!! try agin");'.'</script>';
	}
?>


<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Buzz|SIGN-UP</title>
        <link rel="stylesheet" href="css/style2.css">
        <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
         <link rel="shortcut icon" type="image/png" href="images/icon.png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet'  type='text/css'>
    </head>
<body>
    <header>
        <div class="row">
            <div class="logo">
				<a href="index.html"><img src="images/Buzz-Logo.png"></a>
            </div>
        	<ul class="main-nav">
				<li ><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
				<li  class="active" ><a href="sign-up.php"><span class="glyphicon glyphicon-user"></span> Signup</a></li>
			</ul>
        </div>
	</header>
        <div class="container-fluid bg1">
            <div class="row">
                <div class="col-md-4 col-sm-4 col sm-4"></div>
                <div class="col-md-4 col-sm-4 col sm-4">
                 <form class="form-container"  name="registration" id="registration"  method="post">
                     <p>
                         <b>	Enter your personal details below:</b>
							</p>
                     
								<input type="text"  name="full_name"  required>
								<label alt='First Name' placeholder='Type your First name'></label>
							
							<div class="form-group">
								<input type="text" class="form-control" name="last_name"  required>
								<label alt='Last Name' placeholder='Type your Last Name'></label>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="address"  required>
								<label alt='Address' placeholder='Type your Address'></label>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="city"  required>
								<label alt='City' placeholder='Type your City'></label>
							</div>
							<div class="form-group">
								<label for="gender" class="block">
									<b>Gender</b>
								</label>
								<p style="visibility: false; color: red;>can"t leave empty!! select gender<br></p>
								<div class="clip-radio radio-primary">
									<input type="radio" id="rg-female" name="gender" value="female" >
									<label for="rg-female">
										<b>Female
									</label>
									<input type="radio" id="rg-male" name="gender" value="male">
									<label for="rg-male">
										<b>Male
									</label>
								</div>
							</div>
                     <p>
							<b>Enter your account details below:</b>	
							</p>
                     <div class="form-group">
								<span class="input-icon">
									<input type="email" class="form-control" name="email" id="email" onBlur="userAvailability()"  placeholder="Email" required>
									<i class="fa fa-envelope"></i> </span>
									 <span id="user-availability-status1" style="font-size:12px;"></span>
							</div>
							<div class="form-group">
								<span class="input-icon">
									<input type="password" pattern=".{4,}" required title="minimum 4 characters required" class="form-control" id="password" name="password" placeholder="Password" required>
									<i class="fa fa-lock"></i> </span>
							</div>
							
                     <input type="submit"  value="Sign Up" id="submit" name="submit">
                    </form>
                </div>
            </div>
        </div>
     	<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
		<script src="assets/js/main.js"></script>
		<script src="assets/js/login.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Login.init();
			});
		</script>
		
	<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'email='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}


</script>	
        <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
        
    </body>
</html>
