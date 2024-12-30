<?php
include_once("connection.php");
session_start();
?>

<form action="onlineshow.php" method="POST">

<label for="start">Show totals from:</label>
<input type="date" name="date">
<input type="submit" value="See totals">

</form>


