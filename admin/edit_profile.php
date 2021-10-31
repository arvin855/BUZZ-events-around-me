<?php 
require 'functions/functions.php';
session_start();
ob_start();
// Check whether user is logged on or not
if (!isset($_SESSION['user_id'])) {
    header("location:index.php");
}
// Establish Database Connection
$conn = connect();
?>

<?php

    $current_id = $_SESSION['user_id'];
    
?>
<?php
if(isset($_POST['up']))
{
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $address=$_POST['address'];
    $city=$_POST['city'];
    $email=$_POST['email'];
    $pass=($_POST['pass']);
    $sql="Update users set fname='$fname',lname='$lname',address='$address',city='$city',email='$email',password='$pass' where user_id='$current_id'";
    $query = mysqli_query($conn, $sql); 
    if($query)
    {
        echo '<script>alert("Successfully updated");</script>';
        #header('location:home.php');
    }
    else
        echo '<script>alert("unsuccessful!! try agin");</script>';
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>BUZZ |profile</title>
    <link rel="stylesheet" type="text/css" href="resources/css/main.css">
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
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
       
        <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        

    <style>
    .bg{
    background: url('images/tree.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center fixed; 
    
   
}
i:hover{
			color:blue;
		}
    .path{
        width:200px;
    }
    .logo img
		{
			width: 100px;
			height: auto;
			float: left;
			margin: 10px;
		}
        .ab{
            margin: 10px;
            padding-top: 10px;
        }
    .post{
        margin-right: 50px;
        margin-bottom: 18px;
    }
    .profile{
        position:fixed;
        width:200px;
        height:auto;
        margin-top:45px;
        margin-left: 30px;
        float: left;
        background: rgba(0,0,0,.8);
        box-shadow: 0 0 5px #4267b2;
        padding: 20px;
    }
    input[type="file"]{
        display: none;
    }
    label.upload{
        cursor: pointer;
        color: white;
        background-color: #4267b2;
        padding: 8px 12px;
        display: inline-block;
        max-width: 80px;
        overflow: auto;
    }
    label.upload:hover{
        background-color: #23385f;
    }
    .changeprofile{
        color: #23385f;
        font-family: Fontin SmallCaps;
    }
    .box{
        margin-top:60px;
       margin-left:180px;
        width :800px;
        height: 800px;
        padding:30px;
        background: rgba(0,0,0,.8);
       box-shadow: 0 0 5px #4267b2;
        border-radius: 10px; 
    }
    .box h2{
        margin: 0 0 30px;
        padding: 0;
        color: #fff;
        text-align: center;
    }
    .box .inputBox textarea{
        width: 100%;
        padding: 10px 0;
        font-size: 16px;
        color: #fff;
        margin-bottom: 20px;
        Letter-spacing: 2px;
        border: none;
        border-bottom: 1px solid #fff;
        outline: none;
        background: transparent;
    }                        
    
    .box .inputBox input{
        width: 100%;
        padding: 10px 0;
        font-size: 16px;
        color: #fff;
        margin-bottom: 20px;
        Letter-spacing: 2px;
        border: none;
        border-bottom: 1px solid #fff;
        outline: none;
        background: transparent;
    }
    .box .inputBox label{
        
       
        padding: 10px 0;
        font-size: 16px;
        color: #03a9f4;
        pointer-events: none;
        transition: .5s;
    }
    
    </style>
</head>
<body class="bg">
    <div class="container">
        <!-- start of navebar-->
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
                <li ><a href="eventpost.php"><i class="fas fa-camera-retro fa-lg"> Post</i></a></li>
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

<!-- end of nav bar-->
       
               
                 

                <!-- upload profile pic -->
            <!--    <div class="profile">
                    <center class="changeprofile"><h4 style="color:white;">Change Profile Picture</h4></center>
                    <br>
                    <form action="" method="post" enctype="multipart/form-data">
                            <div class="path">
                            <label class="upload" onchange="showPath()">
                                <span id="path" style="color: white;">... Browse</span>
                                <input type="file" name="fileUpload" id="selectedFile">
                            </label>
                            </div>
                        <br>
                        <input type="submit" value="Upload Image" name="profile">
                    </form>
                </div> -->
        

                <!-- other details upload-->
                <?php $sql="select * from users where user_id='".$_SESSION['user_id']."'";
                   $sql1 = mysqli_query($conn, $sql); 
while($data = mysqli_fetch_array($sql1))
{?>
               
                <div class="box">
                <header>
                <h2 >Edit profile</h2>
                </header>
                <form  method="post" enctype="multipart/form-data">
                    
                       

                        <div class="inputBox">
                        <label>First Name</label>
                        <input type="text" name="fname" class="form-control" value="<?php echo htmlentities($data['fname']);?>" >
                        </div>

                        <div class="inputBox">
                        <label>Last Name</label>
                        <input type="text" name="lname" class="form-control" value="<?php echo htmlentities($data['lname']);?>" >
                        </div>

                         <div class="inputBox">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" value="<?php echo htmlentities($data['address']);?>" >
                        
                        </div>

                         <div class="inputBox">
                        <label>City</label>
                        <input type="text" name="city" class="form-control" value="<?php echo htmlentities($data['city']);?>" >
                        </div>

                        <div class="inputBox">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo htmlentities($data['email']);?>" >
                        </div>

                        <div class="inputBox">
                        <label>Password</label>
                        <input type="text" name="pass" class="form-control" value="<?php echo htmlentities($data['password']);?>" >
                        </div>

                        <br>
                        <div class="form-group">
                        <center><input type="submit" name="up" class="btn btn-primary">
                        </div>
                </form>
                </div>
                
                
                </div>
                
            
                <br>
                
                <br> 
                
                <?php
            }
        
        ?>
    </div>




    <script src="resources/js/jquery.js"></script>
    <script>
    function showPath(){
    var path = document.getElementById("selectedFile").value;
    path = path.replace(/^.*\\/, "");
    document.getElementById("path").innerHTML = path;
    }       
        // Invoke preview when an image file is choosen.
       
    </script>
	<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
        <script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>
		<script>
        
   
		
</body>

</html>
<?php include 'functions/upload.php'; ?>

