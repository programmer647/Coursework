<?php
include_once("connection.php");
session_start();

array_map("htmlspecialchars",$_POST);//prevents SQL injection by making special characters in the post array not have any impact

$date = date('Y-m-d');//sets the variable date to the current date

if (!isset($_SESSION['orderid']))
{
    $stmt=$conn->prepare("INSERT INTO Tblorders(UserID,Datecreated,Online) Values(:userid,:datecreated,1)");
    $stmt->bindParam(':userid',$_SESSION['id']);
    $stmt->bindParam(':datecreated',$date);
    $stmt->execute();
    //This code inserts the UserID and date into the orders table which causes a new OrderID to be created because it is an auto-increment primary 
    //key. This OrderID will then be used to connect to the onlineorders table
    
    $stmt=$conn->prepare("SELECT MAX(OrderID) from Tblorders");//selects the largest OrderID from the table which will be the order which has 
    //just been created because the OrderID is autoincrement 
    $stmt->execute();
    while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
    {
    $_SESSION['orderid']=$row['MAX(OrderID)'];//sets the session orderid to the new one which has been created
    }
}

$quantity=$_POST['quantity'];
$typeid=$_POST['TypeID'];

$stmt=$conn->prepare("SELECT * FROM Tbltype where TypeID=:typeid");
$stmt->bindParam(':typeid',$typeid);
$stmt->execute();
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    $price=$row['Price'];
}

$stmt=$conn->prepare("SELECT * FROM TblOnlineorders WHERE OrderID=:orderid and TypeID=:typeid");//checks to see if there is already an item of the same type in the basket and 
//if there is it takes the quantity of it so that this can be altered and then updated
$stmt->bindParam(':orderid',$_SESSION['orderid']);
$stmt->bindParam(':typeid',$typeid);
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
    $q=$row['Quantity'];
    if ($q>0){
        $quantity=$q+$quantity;
}
}

$stmt=$conn->prepare("SELECT Quantity FROM tblonlineorders WHERE TypeID=:typeid and OrderID=:orderid");
$stmt->bindParam(':typeid', $typeid);
$stmt->bindParam(':orderid',$_SESSION['orderid']);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
if ($row!=[]){
    $stmt=$conn->prepare("UPDATE Tblonlineorders SET Quantity=:quantity WHERE TypeID=:typeid");
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':typeid',$typeid);
    $stmt->execute();
}
else{
    $stmt=$conn->prepare("INSERT INTO Tblonlineorders(OrderID,TypeID,Quantity) VALUES (:orderid,:typeid,:quantity)");
    $stmt->bindParam(':orderid',$_SESSION['orderid']);
    $stmt->bindParam(':typeid',$typeid);
    $stmt->bindParam(':quantity',$quantity);
    $stmt->execute();
}

$stmt=$conn->prepare("SELECT * FROM Tblorders where OrderID=:orderid");//selects the rows of the table where the typeID is equal to the typID searched for
$stmt->bindParam(':orderid',$_SESSION['orderid']);
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    $total=$row['Total'];
}

$total=$total+$price*($_POST['quantity']);//adds the price to the total for the orders table

$stmt=$conn->prepare("UPDATE Tblorders SET Total=:total WHERE OrderID=:orderid");//updates the orders table to include the new total
$stmt->bindParam(':total', $total);
$stmt->bindParam(':orderid',$_SESSION['orderid']);
$stmt->execute();

?> 

<!DOCTYPE html>
<html>
        
<head>
    
    <title>Shop</title><!--sets the title of the page-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"><!--links to the bootstrap -->
    <link rel="stylesheet" href="style.css"/><!--links to the external style sheet-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<!--creating the navbar-->
<nav class="navbar navbar-fixed-top"><!--fixes the navbar to the top of the page-->
        <div class="container-fluid">
          <ul class="nav navbar-nav">
            <li><a href="loggedouthome.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li class="active"><a href="shop.php">Shop</a></li><!--sets the shop page to the active link so that it appears a different 
            colour so that the user knows which page they are currently on-->
            <li><a href="news.php">News</a></li>
            <li><a href="faqs.php">FAQs</a></li>
            <li><a href="uniformlists.php">Uniform Lists</a></li>
            <?php
            if (!isset($_SESSION['name'])){
                echo("<li><a href='login.php'>Login/Sign up</a></li>");
            }
            else{
                echo("<li><a href='account.php'>My Account</a></li>
                <li><a href='logout.php'>Log out</a></li>");
            }
            ?>

          </ul>
        </div>
      </nav>

      <body>

<div class="centered box white">
    <h3>Basket</h3>
    <?php
    $stmt=$conn->prepare("SELECT Name as n, Size as s, Price as p, Quantity as q, Total as t FROM Tblonlineorders 
    INNER JOIN tblorders ON tblonlineorders.OrderID=tblorders.OrderID
    INNER JOIN tbltype ON tblonlineorders.TypeID=tbltype.TypeID
    INNER JOIN tblitems ON tbltype.ItemID=tblitems.ItemID
    WHERE tblonlineorders.OrderID=:orderid");
    $stmt->bindParam(':orderid',$_SESSION['orderid']);
    $stmt->execute();
    echo("Name, Size, Price, Quantity</br>");
    while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        echo($row['n'].", ".$row['s'].", £".$row['p'].", ".$row['q']."</br>");
        $total=$row['t'];
    }
    echo("£".$total);
    ?>
    </br>
    <button onclick="location.href='shop.php'" type="button" class="btn btn-secondary" action="shop.php">Continue Shopping</button>
    <button onclick="location.href='deliveryoption.php'" type="button" class="btn btn-secondary" action="checkoutbutton.php">Checkout</button>
</div>


</body>

</html>