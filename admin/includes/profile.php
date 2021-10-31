<?php
echo '<div class="fixed">';
echo '<div class="col-sm-4"></div>
<div class="col-sm-3" style="position: fixed-top; background-color: #ffffff; height: 400px; width:300px;  margin-top: 30px; border-radius: 5px; border-top: 5px solid; border-top-color: red; border-bottom: 10px solid; border-bottom-color: #5352ed; box-shadow: 1px 1px 10px; ">';
echo '<br>';
echo '<center>';
/** echo "hello";*/
$row = mysqli_fetch_assoc($profilequery);
// Name and Nickname
echo '<b>';
if(!empty($row['user_nickname']))
    echo $row['fname'] . ' ' . $row['lname'] . ' (' . $row['user_nickname'] . ')';
else
    echo '<p style="color:#9933ff; display:inline;">'.$row['fname'] . ' ' . $row['lname'].'</p>';
echo '<br>';
echo '<br>';
// Profile Info & View
$width = '168px';
$height = '168px';
include 'profile_picture.php';
echo '<br>';
echo '<br>';
echo '<br>';
// Gender
if($row['gender'] == "male")
    echo '<p style="color:red; display:inline;">Gender: </p> <p style="color:green; display:inline;">Male</p>';
else if($row['gender'] == "female")
    echo '<p style="color:red; display:inline;">Gender: </p> <p style="color:green; display:inline;">Female</p>';

// Status

// Birthdate
// Additional Information
if(!empty($row['address'])){
    echo '<br>';
    echo '<p style="color:red; display:inline;">Address: </p> <p style="color:green; display:inline;">'. $row['address'].'</p>';
}
if(!empty($row['city'])){
    echo '<br>';
    echo '<p style="color:red; display:inline;">City: </p><p style="color:green; display:inline;">' .$row['city'].'</p>';
}
echo '<br>';
echo '<p style="color:red; display:inline;">Email: </p><p style="color:green; display:inline;">' .$row['email'].'</p>';

echo '</center>'; 

echo '</div>';
echo '</div>';


?>

	<style type="text/css">
		.list ul li {
			display: inline-block;
            margin:10px;
            
			
		}
        .fixed {
                position: fixed;
                margin-top:-50px;
                
                
        }
		
	</style>