<?php
    if(isset($_POST['book']))
    {
        $otp1 = $_POST['verify'];
        if( $_COOKIE['otp'] == $otp1)
        {   
            $event_date = $row['pdate'];
            $post_id = $row['post_id'];
            $user_id = $_SESSION['user_id'];
            $tcount = $_POST['ticketnum'];
            $tid = $_POST['verify'];
            $tamt= $_POST['pri'];
            $upcnt = $row['pticket'] - $tcount;
            $sql = "Update posts set pticket='$upcnt' where post_id='$post_id'";
            $query1 = mysqli_query($conn, $sql);
            $sql1 = "insert into ticket(post_id,event_date, user_id, ticket_count, ticket_id, ticket_amount) values('$post_id','$event_date','$user_id','$tcount','$tid','$tamt')";
            $query = mysqli_query($conn, $sql1); 

            if($query && $query1)
            {
               
                header("refresh:0;url=home.php");
                echo '<script>'.'alert("Successfully booked! You will be redirected to home page");'.'</script>';
            }
            else
                echo '<script>alert("unsuccessful!! try!!! again");</script>';
        }
        else
            echo '<script>alert("Unsuccessful !! verify Ticket ID again");</script>';
    }
?>

<?php
date_default_timezone_set('Asia/Kolkata');
$today = date("Y-m-d");
if($today <= $row['pdate'])
{
    echo '<div class="fixed">';
    echo '<div class="col-sm-4"></div>
    <div class="col-sm-3" style="background-color: #ffffff; height: 600px; width:400px;  margin-top: 14px; border-radius: 5px; border-top: 5px solid; border-top-color: red; border-bottom: 5px solid; border-bottom-color: #5352ed; box-shadow: 1px 1px 10px; ">';
    echo '<br>';
    echo '<center>';
    ?>
        <h4 class="modal-title">Buy Ticket</h4>
        <form  class="form-inline" name="buyTicket" id="buyTicket"  method="post" >
                                            <div class="form-group">
                                                    <label for="total">Total Available Tickets</label>
                                                    <input class="form-control " value="<?php echo htmlentities($row['pticket']);?>"
                                                            type="text"  readonly />
                                                </div>
                                                <div class="form-group">
                                                    <label for="price">Price Of One Ticket</label>
                                                    <input class="form-control " value="<?php echo htmlentities($row['tprice']);?>"
                                                            type="text" readonly />
                                                </div> 
                                                <div class="form-group">
                                                    <label for="inputPassword">Select Numbers Of Tickets(max 10)</label>
                                                    <p id="p11" style="display:none;color:red;">Select Number of tickets <= <?php echo htmlentities($row['pticket']);?></p>
                                                    <select required name="ticketnum" id="pr" class="chosen-select" onclick="varify();" onchange="getSelectValue();" required="required">
                                                                    <option value="<?php if(isset($_POST['ticketnum'])){ echo htmlentities($_POST['ticketnum']); }?>"><?php if(isset($_POST['pri'])){ echo htmlentities($_POST['pri']); }?></option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                    <option value="6">6</option>
                                                                    <option value="7">7</option>
                                                                    <option value="8">8</option>
                                                                    <option value="9">9</option>
                                                                    <option value="10">10</option>
                                                    </select>

                                                </div> 
                                                
                                                <div class="form-group">
                                                    <label for="inputPassword">Total Amount= </label>
                                                    <i class="fas fa-rupee-sign"> </i>
                                                    <input class="form-control"   name="pri" type="text" id="pri" value="<?php if(isset($_POST['pri'])){ echo htmlentities($_POST['pri']); }?>" readonly/>
                                                    
                                                </div> 
                                                <div class="form-group">
                                                    <label for="inputname">Enter Name</label>
                                                    <input class="form-control"   name="name"  type="text" id="name" value="<?php if(isset($_POST['name'])){ echo htmlentities($_POST['name']); }?>" required/>
                                                    
                                                </div> <br>
                                                <div class="form-group">
                                                    <label for="inputPassword">Enter Mobile Number</label>
                                                    <input required class="form-control" type="text" name="mob" id="mob" value="<?php if(isset($_POST['mob'])){ echo htmlentities($_POST['mob']); }?>" />
                                                    </div> 
                                                    <input style="float:right;" class="btn btn-warning" type="submit" name="otp" id="otp" value="Send Ticket ID">
                                            
                                                <br>
            <?php
            $flag = 0;
            if(isset($_POST['otp']))
            {
                $mob = $_POST['mob'];
                $len = strlen($mob);
                if($mob == ""){
                    echo '<p data-target="#loginModal" data-toggle="modal" style="color:red;">cannot be empty</p>';
                }
                elseif(!(is_numeric($mob))){
                    echo '<p style="color:red;">Must be only numeric values</p>';
                }
                elseif($len < 10)
                {
                    echo '<p style="color:red;">Moblie number cannot be less than 10</p>';
                }elseif($len > 10){
                    echo '<p style="color:red;">Mobile number cannot be more than 10 digits<?p>';
            }elseif(preg_match("/^[789]{1}\d{9}+$/",$mob)){
                        $flag = 1;
            }
            else
                echo '<p style="color:red;">Only indian mobile numbers allowed.. starts with 7/8/9</p>';
            
            if($flag == 1)
            {
                require('textlocal.class.php');
                require('credintials.php');

                $textlocal = new Textlocal(false,false,API_KEY);

                $numbers = array($_POST['mob']);
                $sender = 'TXTLCL';
                $otp = mt_rand(10000, 99999);
                $message = "Hello  ".$_POST['name'] ." Your ticket ID is: ". $otp ." "."Amount to be paid during event visit = ".$_POST['pri'];

                try {
                    $result = $textlocal->sendSms($numbers, $message, $sender);
                    setcookie('otp',$otp);
                    echo '<p style="color:green;">Ticket ID Successfully Sent To Mobile..</p>';
                } catch (Exception $e) {
                    echo "Error:". $e->getMessage();
                }
            }
            }
            ?>
                                            <div class="form-group">
                                                    <label for="inputPassword">Enter Ticket ID</label>
                                                    <input  class="form-control" type="text" name="verify" id="verify" value="<?php if(isset($_POST['verify'])){ echo htmlentities($_POST['verify']); }?>"  />
                                            </div> 
                                                    <input style="float:right;" class="btn btn-warning" id="verifyotp" type="submit" name="verifyotp" value="Verify ID">
                                            
                                                    <br>
            <?php
            
                if(isset($_POST['verifyotp']))
                {       
                        if($_POST['verify']!= "")
                        {
                            $otp1 = $_POST['verify'];
                            if($_COOKIE['otp'] == $otp1){
                                echo '<script type="text/javascript">' . 
                                'document.getElementById("sub").disabled = false;' .
                                '</script>';
                                echo '<p style="color:green;">Congo Ticket ID Matched</p>';
                            
                            }else {
                                echo '<p style="color:red;">Please Enter Correct Ticket ID</p>';
                            }
                        }else{
                            echo '<p style="color:red;">Cannot Be Empty</p>';
                        }
                            
                }
            
            
            ?>
            
            <br><br>
            <center>
            <input class="btn btn-success"  type="submit" id="sub" name="book" value="Book Ticket">
                                                </form>
    <?php
    echo '</div>';
    echo '</div>';
}
else{
    echo '<div class="fixed">';
    echo '<div class="col-sm-4"></div>';
    ?>
     <img  src="images/closed.png">

    <?php
        echo '</div>';
}


?>


<?php

echo '<div class="column-layout">';

echo '<div class="main-column">';
include 'profile_picture.php';
echo ' <a class="profilelink" href="profile_samp.php?id=' . $row['user_id'] .'">' . $row['fname'] . ' ' . $row['lname'] . '</a>';
echo '<b><p style="float: right;"><span class="postedtime">' . $row['post_time'] . '</span>';
echo '</p></b>';
echo '<br><b><i><br>';
echo '<p class="caption">' . $row['post_caption'] . '</p></b></i>';
echo '<br>';
echo '<center>'; 
$target = glob("../data/images/posts/" . $row['post_id'] . ".*");
if($target) {
    echo ' <a id="txtName" data-toggle="tooltip"
    title="click to get full detail" class="profilelink" href="eventdetail.php?id=' .$row['post_id'].'"><img class="center-block img-responsive" src="' . $target[0] . '" style="max-width:580px"> '; 
    echo '</a><br><br>';
    
}
echo '</center>';
echo '</div>';

?>



<div class="main-column">
                        <h3>Event Discription</h3>
                            <p class="p1"> <?php echo htmlentities($row['post_caption']);?> <p> 
                            <!--end of text area -->
                            <br>
                            <h3>Event Address</h3>
                             <p class="p1"> <?php echo htmlentities($row['paddress']);?></p>
                             
                             <h3> MAP/Location </h3>
                                <div class="map">
                                    <?php 
                                        $add = $row['paddress'];
                                        $split = explode(',',$add);
                                        $count = count($split);
                                        $map = $split[0];
                                        for($i=1;$i<$count;$i++)
                                            $map = $map.',+'.$split[$i];
                                    
                                    ?>
                                    <iframe width="700" height="350" frameborder="0" style="border:0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;h1=en&amp;geocode=&amp;q=<?php echo $map;?>&amp;ie=UTF8&amp;hq&amp;hnear=<?php echo $map;?>&amp;z=12&amp;||=&amp;output=embed" allowfullscreen>my map</iframe>
                                </div>
                           
                            <br>
                             <h3>Event date</h3>
                             <p class="p1"> <?php echo htmlentities($row['pdate']);?></p>

                             <h3>Total Number To Tickets Available</h3>
                             <p class="p1"> <?php echo htmlentities($row['pticket']);?></p>

                             <h3>Price Of A Single Ticket</h3>
                             <p class="p1"><i class="fas fa-rupee-sign"></i> <?php echo htmlentities($row['tprice']);?></p>


                            <!-- for popup to buy tickets 
                           
                    
                </div>  

</div>   







<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
            
        
            function getSelectValue()
        {
            var selectedValue = document.getElementById("pr").value;
            if( selectedValue <= <?php echo htmlentities($row['pticket']);?>)
            {
                var price = selectedValue * <?php echo htmlentities($row['tprice']);?>;
                document.getElementById("pri").value = price;
                document.getElementById("p11").style.display = "none";
                document.getElementById("name").disabled = false;
                document.getElementById("mob").disabled = false;
                document.getElementById("otp").disabled = false;
                document.getElementById("verify").disabled = false;
                document.getElementById("verifyotp").disabled = false;
                document.getElementById("sub").disabled = false;
                
            }
            else
            {
                document.getElementById("p11").style.display = "block";
                document.getElementById("name").disabled = true;
                document.getElementById("mob").disabled = true;
                document.getElementById("otp").disabled = true;
                document.getElementById("verify").disabled = true;
                document.getElementById("verifyotp").disabled = true;
                document.getElementById("sub").disabled = true;
               
            }
            
        }
        getSelectValue();
        </script>
<script src="chosen.jquery.js"></script>
	<script >
	$('.chosen-select').chosen();
	</script>

<script>
    $(document).ready(function () {
        $('#txtName').tooltip();
    });
</script>


<style>
body {
  background-color: #BBB;
  font-family: Helvetica, sans-serif;
  padding-bottom: 100px;
}
.form-inline .form-group {
  margin:10px;
  
}
.p1{
    border-left: 6px solid red;
    background-color: lightgrey;
    padding: 10px;
}

.map{
    border: 1px solid black;
}
span,i{
    display: inline;
}
.modal{
    background: rgba(76, 175, 80, 0.3);
    
}
.main-column{
    margin-top:10px;
}
.column-layout {
  float:left;
  max-width: 800px;
  background-color: #FFF;
  margin-left:-15px;
  line-height: 1.65;
  padding: 20px 50px;
  display: block;
}
.fixed {
    position: fixed;
    left:920px;
    margin-top:-90px;
    float : right;  
    padding:2px;
        }
/**
.fixed {
    position: fixed;
    left:1050px;
    margin-top:-80px;
    float : right;  
    padding:2px;
        }
    .fixed1 {
    position: fixed;
    left:1050px;
    margin-top:-60px;
    float : right;  
    padding:2px;
        } **/
</style>
