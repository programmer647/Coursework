<!DOCTYPE html>
<html>
<head>
    <title>Totals</title>

    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>
<body>


<nav class="navbar navbar-default">
        <div class="container-fluid">
          <ul class="nav navbar-nav">
            <li><a href="checkoutbarcode.php">Barcode checkout</a></li>
            <li class="active"><a href="showtotals.php">View totals</a></li>
            <li><a href="login.php">Login</a></li>

          </ul>
        </div>
      </nav>



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
?>
</form>

<input type="submit" value="Show totals for this sale">

</html>