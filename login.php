<?php
session_start();
error_reporting(0);
include("includes/config.php");
if(isset($_POST['submit']))
{
    $ret=mysql_query("SELECT * FROM users WHERE email='".$_POST['email']."' and password='".$_POST['password']."' and user_status='active' ");
    $num=mysql_fetch_array($ret);
    if($num>0)
    {
        if($num['catagory'] == "user")
        {
        $_SESSION['user_id']=$num['user_id'];
        header("location:home.php");
        }else{
            $_SESSION['user_id']=$num['user_id'];
             header("location:admin/home.php");
        }
    
    }
    else
    {
        $_SESSION['login']=$_POST['email'];	

        //$status=0;
        //mysql_query("insert into userlog(username,status) values('".$_SESSION['login']."','$uip','$status')");
        $_SESSION['errmsg']= "Invalid email Id or password";
        $extra="login.php";
        $host  = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        header("location:http://$host$uri/$extra");
        exit();
    } 
}
?>




<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Buzz|LOGIN</title>
        <link rel="stylesheet" href="css/style.css">
         <link rel="shortcut icon" type="image/png" href="images/icon.png">
         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
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
            <li class="active"><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            <li ><a href="sign-up.php"><span class="glyphicon glyphicon-user"></span> Signup</a></li>
            </ul>
            
         </div>
            </header>
        <div class="container-fluid">
            <div class="bg"></div>
            <div class="row">
                <div class="col-md-4 col-sm-4 col sm-4"></div>
                <div class="col-md-4 col-sm-4 col sm-4">
        <form class="form-container"  name="login" id="login"  method="post">

          <center>
			<label for="title" style="font-size:25px;">
				Sign into your account
            </label>
        
			<p>
		    	<b style="color:white;"> Please enter Email Id and password.<br />
				<b><span style="color:red;font-size:15px;"><?php echo $_SESSION['errmsg']; ?><?php echo $_SESSION['errmsg']="";?></span>
                </b></p>
            <div class="form-group">
            <label for="Email1">Email</label>
            <input type="email"  name="email" class="form-control" id="Email1" placeholder="Email" autocomplete="off">
            </div>
            <div class="form-group">
            <label for="Password1">Password</label>
            <input type="password" pattern=".{4,}" required title="4 characters mini" name="password" class="form-control" id="Password1" placeholder="Password min 4 characters" autocomplete="off">
            </div>
           
                     <input type="submit" value="Login" name="submit">
                     </center>
        </form>
                </div>
            </div>
        </div>
        
        <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    </body>
</html>
