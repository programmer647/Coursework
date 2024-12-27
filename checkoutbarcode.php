<?php
session_start(); 
include_once("connection.php");
?>

<form action="addtobasket.php" method="POST">
<label for="uniformid">Scan barcode:</label>
<input type="number" name="uniformid">
<input type="submit" value="Add to basket">
