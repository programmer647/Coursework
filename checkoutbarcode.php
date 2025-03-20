<?php
session_start();//allows the page to access the session variables
include_once("connection.php");//connects the page to the database
?>

<form action="addtobasket.php" method="POST"><!--creates the form which takes in the barcode and sets the submit method to post so that the data
goes to the next page in the form of a post array-->
<label for="barcode">Scan barcode:</label><!--creates a label for the barcode input-->
<input type="number" name="barcode" required><br><!--creates an input box for the barcode and then a line break-->
<label for="new">New?</label><!--creates a label for the check box for whether an item is new or not-->
<input type="checkbox" name="new" value="1"><!--creates the checkbox which is clicked if the item is new-->
<br>
<input type="submit" value="Add to basket"><!--creates the submit button which sends the data to the addtobasket page-->

<br>
</form><!--ends the form-->

<form action="complete.php"><!--creates another form which is for when all of the items have been scanned-->
<input type="submit" value="Complete transaction">
</form>

<?php
$stmt=$conn->prepare("SELECT tblitems.name as n, tbltype.size as s, tbltype.price as p, tblbasket.quantity as q, tblorders.OrderID, tblbasket.new as new FROM Tblorders
INNER JOIN Tblbasket on Tblbasket.OrderID=Tblorders.OrderID
INNER JOIN Tbluniform on Tbluniform.UniformID=Tblbasket.UniformID
INNER JOIN Tbltype on Tbltype.TypeID=Tbluniform.TypeID
INNER JOIN Tblitems on Tblitems.ItemID=Tbltype.ItemID
WHERE tblorders.OrderID=:orderid");
$stmt->bindParam(":orderid",$_SESSION['orderid']);
$stmt->execute();
echo("Name, Size, Price, Quantity");
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    echo("<br>");
    if ($row['new']==1){
        echo($row['n'].', '.$row['s'].', '.$row['p']*1.65.', '.$row['q']);
    }
    else{
        echo($row['n'].', '.$row['s'].', '.$row['p'].', '.$row['q']);
    }
    
}

//checks if the OrderID session variable has been set
if (isset($_SESSION['orderid'])){
$stmt=$conn->prepare("SELECT Total FROM Tblorders WHERE OrderID=:orderid");
$stmt->bindParam(":orderid",$_SESSION['orderid']);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
echo("<br>");
echo("Total: £".$row['Total']);
}

?>
