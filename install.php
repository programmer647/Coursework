<?php
//connecting to the database using the connection file
include ("connection.php");

//creating users table
$stmt=$conn->prepare("DROP TABLE IF EXISTS Tblusers;
CREATE TABLE Tblusers
(UserID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Forename VARCHAR(20) NOT NULL,
Surname VARCHAR(20) NOT NULL,
Username VARCHAR(20) NOT NULL,
Password VARCHAR (200) NOT NULL,
Role TINYINT(1))");
$stmt->execute();
$stmt->closeCursor();
?>