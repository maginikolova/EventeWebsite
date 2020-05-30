<?php

require_once('../includes/connection.php');
if (isset($_POST['delete']) && isset($_POST['id'])){
	
	
	$id = $_POST['id'];
	
	$sql = "DELETE FROM events WHERE id = $id";
	$query = $pdo->prepare( $sql );
	if ($query == false) {
	 print_r($pdo->errorInfo());
	 die ('Error prepare');
	}
	$res = $query->execute();
	if ($res == false) {
	 print_r($query->errorInfo());
	 die ('Error execute');
	}
	
}elseif (isset($_POST['title']) && isset($_POST['color']) && isset($_POST['id']) && isset($_POST['start']) && isset($_POST['end'])){
	
	$id = $_POST['id'];
	$title = $_POST['title'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$color = $_POST['color'];
	
	$sql = "UPDATE events SET  title = '$title', color = '$color', start = '$start', end = '$end' WHERE id = $id ";

	
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
header('Location: index.php');
	
?>
