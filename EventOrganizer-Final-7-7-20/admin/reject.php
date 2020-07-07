<?php
    include("../includes/request.php");
    $id = $_GET['id'];
    
    $query = "DELETE FROM `requests` WHERE `requests`.`id` = '$id';";
        if(performQuery($query)){
            echo "Event has been rejected.";
        }else{
            echo "Unknown error occured. Please try again.";
        }

?>
<br/><br/>
<a href="panel.php">Back</a>