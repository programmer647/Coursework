<?php
session_start(); 
include_once("connection.php");
?>

<form action="addtobasket.php" method="POST">
<label for="uniformid">Scan barcode:</label>
<input type="number" name="barcode">
<br>
<input type="submit" value="Add to basket">
<br>
</form>

<form action="complete.php">
<input type="submit" value="Complete transaction">
</form>


