<?php

$host='localhost';
$db = 'krs';
$username = 'root';
$password = '';


$dsn= "mysql:host=$host;dbname=$db;charset=utf8";

try{
    // create a PDO connection with the configuration data
    $conn = new PDO($dsn, $username, $password);

    // display a message if connected to database successfully
    if($conn){
//        echo "Connected to the <strong>$db</strong> database successfully!<br>";
    }
}catch (PDOException $e){
    // report error message
    echo $e->getMessage();
}



