<?php
session_start();//allows the page to access the session variables

//this code prevents unathorised users from access the page
if ($_SESSION['role']==1)//checks if the user is a customer
{   
    header("Location:customerhome.php");//if the user is a customer not a volunteer or admin they are redirected to the home page
}

?>

<form action="addstock.php" method="POST"><!--creates a form where the barcode can be entered. When the form is submitted the data is sent to 
the next page using the post method-->
<label for="barcode">Scan barcode:</label><!--adds a label to the barcode input-->
<input type="number" name="barcode"><br><!--creates an input field for the barcode-->
<input type="submit" value="Add to stock"><!--creates a button so that the form can be submitted-->



