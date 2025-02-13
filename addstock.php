<?php
include_once("connection.php");//connects the page to the database
session_start();//allows the page to access the session variables

//this code prevents unathorised users from access the page
if ($_SESSION['role']==1)//checks if the user is a customer
{   
    header("Location:customerhome.php");//if the user is a customer not a volunteer or admin they are redirected to the home page
}

header("Location: stock.php");//sends the user back to teh stock page immediately 


//selects the stock from the uniform table where the UniformID matches the barcode scanned
$stmt=$conn->prepare("SELECT Stock FROM tbluniform where UniformID=:id");
$stmt->bindParam(':id',$_POST['barcode']);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$stock=$row['Stock'];//sets the variable stock to the value retreived from the database

$stock=$stock+1;//adds one to the stock

//sets the stock of the uniform item to the new stock variable which is the original stock plus 1
$stmt=$conn->prepare("UPDATE Tbluniform SET Stock=:stock WHERE UniformID=:id");
$stmt->bindParam(':stock',$stock);
$stmt->bindParam(':id',$_POST['barcode']);
$stmt->execute();

?>


