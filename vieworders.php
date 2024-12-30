<?php
session_start();
include_once("connection.php");
?>

<!DOCTYPE html>
<html>
        
<head>
    
    <title>About Us</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"><!--links to the bootstrap -->
    <link rel="stylesheet" href="style.css"/><!--links to the external style sheet-->

</head>

<body>

<div class="container-fluid">
<div class="row">
<div class="col-sm-6">
<h2>Pending</h2>
<?php
$stmt=$conn->prepare("SELECT OrderID FROM Tblorders WHERE Usercompleted=1 AND Uniformready=0 AND Online=1");
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    echo("<a href='detailedorder.php?id=".$row['OrderID']."'>");
    echo("<button>");
    echo($row['OrderID']);
    echo("</button>");
    echo("</a>");
    echo("<br>");
}
?>
</div>

<div class="col-sm-6">
<h2>Ready for dispatch</h2>
<?php
$stmt=$conn->prepare("SELECT OrderID FROM Tblorders WHERE Usercompleted=1 AND Uniformready=1 AND Completed=0 AND Online=1");
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    echo("<a href='onlinecomplete.php?id=".$row['OrderID']."'>");
    echo("<button>");
    echo($row['OrderID']);
    echo("</button>");
    echo("</a>");
    echo("<br>");
}
?>

</div>
</div>
</div>

</body>

