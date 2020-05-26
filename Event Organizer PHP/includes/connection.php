<?php

try{
	$pdo = new PDO('mysql:host=localhost;dbname=kovideui_auto','kovideui_auto','Kovid1234!a');
} catch (PDOException $e){
	exit('DB error. Fix SQL');
}

?>