<?php

include_once("connection.php");

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
</select>

</form>

<input type="submit" value="Show totals">

</html>


