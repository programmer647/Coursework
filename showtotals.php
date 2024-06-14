<!DOCTYPE html>
<html>
<head>
    <title>Totals</title>
</head>

<?php

include_once("connection.php");

//output 
//name of house: total


//name of house
//item + total sold

?>

<form action = "show.php" method="post">
<select name="date">


<?php

$stmt=$conn->prepare("SELECT DISTINCT Datecompleted FROM Tblorders");
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
 {
 	echo('<option value='.$row["Datecompleted"].'>'.$row["Datecompleted"]);
 }


</html>