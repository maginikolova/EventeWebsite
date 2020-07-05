<?php
// Connection to database
require_once('../includes/connection.php');
//echo $_POST['title'];
if (isset($_POST['title']) && isset($_POST['client']) &&isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color']) && 
isset($_POST['organizer']) && isset($_POST['eventType']) && isset($_POST['people']) && isset($_POST['foodType']) && isset($_POST['description']))
{
	$title = $_POST['title'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$color = $_POST['color'];
	$client = $_POST['client'];
	$organizer =  $_POST['organizer'];
	$eventType = $_POST['eventType'];
	$people = $_POST['people'];
	$foodType = $_POST['foodType'];
	$description = $_POST['description'];

	$sql = "INSERT INTO requests(title, start, end, color, client, organizer, eventType, people, foodType, description) values ('$title', '$start', '$end', '$color', '$client','$organizer','$eventType', '$people', '$foodType', '$description')";
	//$req = $pdo->prepare($sql);
	//$req->execute();
	
	echo $sql;
	
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
header('Location: '.$_SERVER['HTTP_REFERER']);
	
?>