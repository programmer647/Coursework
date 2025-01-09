<?php
include_once("connection.php");

$stmt=$conn->prepare("SELECT * FROM Tblusers INTO OUTFILE 'C:/xampp/htdocs/Coursework/test.csv' FIELDS TERMINATED BY ',' LINES TERMINATED BY '\r\n'");
$stmt->execute();

?>

