<!DOCTYPE html>
<html>
<head>
    
    <title>Manual Checkout</title>
    
</head>
<body>

<?php
include_once('connection.php');
?>


<form action = "addtobasket.php" method="post">
<select name="type">

<?php

$stmt=$conn->prepare("SELECT DISTINCT Name FROM Tbltype");//selects every unique name from the type table
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
 {
 	echo('<option value='.$row["Name"].'>'.$row["Name"]);
 }


?>





</body>

</html>