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
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
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


    <style>
   
    .logo img
		{
			width: 100px;
			height: auto;
			float: left;
			margin: 10px;
		}
    .post{
        margin-right: 50px;
        float: right;
        margin-bottom: 18px;
    }
    .profile{
        margin-left: 50px;
        background-color: white;
        box-shadow: 0 0 5px #4267b2;
        width: 220px;
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
    i:hover{
			color:blue;
		}
    .changeprofile{
        color: #23385f;
        font-family: Fontin SmallCaps;
    }
    
    </style>
</head>
<body>
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
        <h1>Profile</h1>
        <?php
        $postsql;
        // Your Own Profile       
            $postsql = "SELECT posts.post_caption, posts.post_time, posts.paddress, users.fname, users.lname,
                                 users.user_id, users.gender,users.address, users.email,
                                posts.post_id
                        FROM posts
                        JOIN users
                        ON users.user_id = posts.post_by
                        WHERE posts.post_by = $current_id
                        ORDER BY posts.post_time DESC";
            $profilesql = "SELECT users.user_id, users.gender,users.address,users.city,
                                 users.fname, users.lname, users.email
                          FROM users
                          WHERE users.user_id = $current_id";
            $profilequery = mysqli_query($conn, $profilesql);
        
        $postquery = mysqli_query($conn, $postsql);    
        if($postquery){
            // Posts
            $width = '40px'; 
            $height = '40px';
            if(mysqli_num_rows($postquery) == 0){ // No Posts
                 // Message shown if it's your own profile
                    echo '<div class="post">';
                    echo 'You don\'t have any posts yet';
                    echo '</div>';
                
                include 'includes/profile.php';
            } else {
                while($row = mysqli_fetch_assoc($postquery)){
                    include 'includes/post.php';
                }
                // Profile Info
                include 'includes/profile.php';
                ?>
               <div class="fixed1">
               <div class="col-sm-4"></div>
            <div class="col-sm-3" style="position: fixed-top; background-color: #ffffff; height: 80px; width:300px;  margin-top: 30px; border-radius: 5px; border-top: 5px solid; border-top-color: red; border-bottom: 10px solid; border-bottom-color: #5352ed; box-shadow: 1px 1px 10px; ">
        <center>   <p style="color:purple;font-size:18px;"><b>Check Ticket Log</b></p>
            <button class="btn btn-primary " style="position:relative; top:-8px;" data-target="#loginModal" data-toggle="modal">View Ticket Log</button>
            </center><div class="modal fade" tabindex="-1" id="loginModal" data-keyboard="false" data-backdrop="static">
                                            <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">
                                                &times;
                                            </button>
                                            <center><p class="modal-title" style="font-size:24px;">Ticket Log</p></center>
                                        </div>
                                        <div class="modal-body">
                                        <?php 
                                     $log = "SELECT ticket.user_id,ticket.ticket_id, users.fname,ticket.ticket_amount,
                                            ticket.event_date,ticket.ticket_count,ticket.regtime
                                    FROM ticket
                                    JOIN users
                                    ON users.user_id = ticket.user_id
                                    WHERE ticket.user_id = $current_id
                                    ORDER BY ticket.regtime DESC";
                                    $log1 = mysqli_query($conn, $log);
                                    if(!$log1 || mysqli_num_rows($log1) == 0){
                                        echo "NO tickets Purchased ";
                                    }
                                    else{
                                        ?>
                                        <table class="table table-hover" id="sample-table-1">
									<thead>
											<tr>
												<th class="center">#</th>
                                                <th>Ticket ID</th>
                                                <th>Event Date</th>
												<th>Number of Tickets</th>
												<th>Amount</th>
												<th>Booking Date & Time </th>
												
											</tr>
										</thead>
										<tbody>
                                    <?php
                                    $cnt=1;
                                    while($row=mysqli_fetch_array($log1))
                                    {
                                    ?><tr>
                                    <td class="center"><?php echo $cnt;?>.</td>
                                    <td class="hidden-xs"><?php echo $row['ticket_id'];?></td>
                                    <td class="hidden-xs"><?php echo $row['event_date'];?></td>
                                    <td><?php echo $row['ticket_count'];?></td>
                                    <td><?php echo $row['ticket_amount'];?></td>
                                    <td><?php echo $row['regtime'];?></td>
                                    </tr>
                                       
                                       
                <?php
                                 $cnt=$cnt+1;   
                                 }?>
                                     </table>
                                <?php } ?>
                                    
                                    
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary"
                                                    data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
</div>
</div>
</div>
                
                                    <?php
            }
        }
        ?>
    </div>
</body>
<script>
function showPath(){
    var path = document.getElementById("selectedFile").value;
    path = path.replace(/^.*\\/, "");
    document.getElementById("path").innerHTML = path;
}

</script>
<!-- table css-->
<style>
.modal {
  
   top: 50px;
  
}
 .fixed1{
                position: fixed;
                margin-top:375px;
                
                
        }
    table{
        color:#fff;
    }
    table, th, td{
        border:1px dotted white;
        border-collapse:collapse;
    }
    th{
        background: purple;
        text-transform: uppercase;
    }
    td:nth-child(6n+1){
        background:red;
    }
    td:nth-child(6n+2){
        background:blue;
    }
    td:nth-child(6n+3){
        background:green;
    }
    td:nth-child(6n+4){
        background:orange;
        color:black;
        text-align: center;
    }
    td:nth-child(6n+5){
        background:yellow;
        color:black;
    }
    td:nth-child(6n+6){
        background:black;
    }


</style>

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
</html>
<?php include 'functions/upload.php'; ?>