<?php

$target = glob("../data/images/profiles/".$row['user_id'].".*");
if($target) {
    echo '<img class="responsive" src="'.$target[0].'" width="'.$width .'" height="'.$height.'">'; 
} else {
    if($row['gender'] == 'male') {
        echo '<img src="../data/images/profiles/M.jpg" width="' . $width . '" height="' . $height .'">';
    } else if ($row['gender'] == 'female') {
        echo '<img src="../data/images/profiles/F.jpg" width="' . $width . '" height="' . $height .'">';
    }
}

?>