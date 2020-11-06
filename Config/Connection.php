<?php 

    $hostname = "localhost";
    $username = "root"; //change the DB username
    $password = "";     //change the DB password
    $dbname = "csrf";   
    
    $connection = mysqli_connect($hostname, $username, $password, $dbname);
    
    if (!$connection){
        die("Database connection failed" .mysqli_connect_error());
    }
?>