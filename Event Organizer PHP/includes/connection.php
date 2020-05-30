<?php

try{
	$pdo = new PDO('mysql:host=localhost;dbname=autonexus','root','');
} catch (PDOException $e){
	exit('DB error. Fix SQL');
}

?>