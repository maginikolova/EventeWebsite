<?php

    function performQuery($query){
        $db_host="localhost";
        $db_user="root";
        $db_password="";
        $db_name="autonexus";
        $con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user, $db_password); 
        $stmt = $con->prepare($query);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    function fetchAll($query){
        $db_host="localhost";
        $db_user="root";
        $db_password="";
        $db_name="autonexus";
        $con = $pdo = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user, $db_password); 
        $stmt = $con->query($query);
   
        return $stmt->fetchAll();
    }

?>