<?php
$db_host="localhost";
$db_user="root";
$db_password="";
$db_name="autonexus";

try{
	$pdo = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user, $db_password); 
	// $pdo = new PDO('mysql:host=localhost;dbname=autonexus','root','');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOEXCEPTION $e){
	$e->getMessage();
}

?>