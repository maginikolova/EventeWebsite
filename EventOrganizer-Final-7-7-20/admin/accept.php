<?php
require_once('../includes/connection.php');
    require_once('../includes/request.php');
    $id = $_GET['id'];
    $query = "select * from `requests` where `id` = '$id'; ";
    if(count(fetchAll($query)) > 0){
        foreach(fetchAll($query) as $row){
            $id = $row['id'];
            $title =  $row['title'];
            $start = $row['start'];
            $end = $row['end'];
            $color = $row['color'];
            $organizer =  $row['organizer'];
            $eventType = $row['eventType'];
            $people = $row['people'];
            $foodType = $row['foodType'];
            $description = $row['description'];
            $sql = "INSERT INTO events(title, start, end, color, organizer, eventType, people, foodType, description) values ('$title', '$start', '$end', '$color', '$organizer','$eventType', '$people', '$foodType', '$description')";
            $query = $pdo->prepare( $sql );
            if ($query == false) {
             print_r($pdo->errorInfo());
             die ('Error prepare');
            }
            $sth = $query->execute();
            if ($sth == false) {
             print_r($query->errorInfo());
             die ('Error execute');
            }
        }
        $query = "DELETE FROM `requests` WHERE `requests`.`id` = '$id';";
        if(performQuery($query)){
            echo "Event has been accepted.";
        }else{
            echo "Unknown error occured. Please try again.";
        }
    }else{
        echo "Error occured.";
    }
    
?>
<br/><br/>
<a href="panel.php">Back</a>