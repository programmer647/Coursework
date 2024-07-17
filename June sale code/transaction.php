<?php
//page that acts as a buffer to the complete page

session_start(); 
include_once("connection.php");

?>


<!DOCTYPE HTML>
<html>

<body>
        
<?php


        
$stmt=$conn->prepare("SELECT Total FROM Tblorders WHERE OrderID=:orderid");
  $stmt->bindParam(':orderid',$_SESSION['orderid']);
  $stmt->execute();
  while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
  {
    echo("</br>");
    echo('Total:');
    echo("</br>");
    echo('£'.$row['Total']);
    echo("</br>");
          echo("</br>");
  }


?>


<form action="complete.php"><!--sets the page to redirect to when the button is pressed-->
  <input type="submit" value="Complete transaction"><!--Creates a button to complete the order by redirecting to the complete.php page-->
</form>
<br>
<form action="checkoutbarcode.php"><!--sets the page to redirect to when the button is pressed-->
  <input type="submit" value="Add more items"><!--Creates a button to complete the order by redirecting to the complete.php page-->
</form>

     </body>   
        </html>