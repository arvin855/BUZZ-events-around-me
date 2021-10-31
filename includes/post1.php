<?php
if(isset($_GET['del']))
{
        $id = $_GET['id'];
        $sql = "delete from posts where post_id = '$id'";
        $res = mysqli_query($conn, $sql);
        if($res)
         {
            echo '<script>'.'alert("Post successfully Deleted");'.'</script>';
            header("location:profile.php");
         }
        
}
echo '<br>';
echo '<div class="edit">';
echo '<div class="post">';

echo '<div>';
include 'profile_picture.php';
echo  ' <a class="profilelink" href="profile_samp.php?id=' . $row['user_id'] .'">'." " .  $row['fname'] . ' ' . $row['lname']. '<a>';
echo '<b><p style="float: right;"><span class="postedtime">' . $row['post_time'] . '</span>';
echo '</p></b>';
echo'</div>';
?>
	<a style="float:right;display:inline;" href="profile.php?id=<?php echo $row['post_id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"class="btn btn-transparent btn-xs tooltips"><i style="color:red;" class="fas fa-trash-alt fa-lg"> Delete Post</i></a>
<br>
<?php
echo '<p style="display:inline;" class="caption">' . $row['post_caption'] . '</p>';


echo '<center>'; 
$target = glob("data/images/posts/" . $row['post_id'] . ".*");
if($target) {
    echo ' <a id="txtName" data-toggle="tooltip"
    title="click to get full detail" class="profilelink" href="eventdetail.php?id=' .$row['post_id'].'"><img class="responsive" src="' . $target[0] . '" style="max-width:580px">'; 
    echo '</a><br><br>';  
}
echo '</center>';
# echo '<button class="btn btn-info pull-right" data-target="#loginModal" data-toggle="modal"><i class="fas fa-map-marker-alt fa-lg"> Map</i></button>';
echo '</div>';
echo '</div>';

?>
                          

                          
                           
<script>
    $(document).ready(function () {
        $('#txtName').tooltip();
    });
</script>

<script>
    $(document).ready(function () {
        $('#btnPopover').popover();
    });
</script>
<style>
.map{
    opacity: 1;
}

.modal{
    background: rgba(76, 175, 80, 0.3);
    
}
    </style>
