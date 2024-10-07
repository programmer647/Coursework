<?php

//sets the variables needed to log on to the database
$servername = "pdb1056.awardspace.net";
$username = "4496312_folss";
$password = "Cloisters2023!!";
$dbname = "4496312_folss";

//this code tries to connect to the database
try {
    //connects to the database by passing in the variables
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; //displays message if the database has been connected to successfuly
    }

catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();//if the connection fails then it prints a message
    }
?>