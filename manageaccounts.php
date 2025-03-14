<?php
session_start();//allows the page to access the session variables
include_once("connection.php");//connects the page to the database
if ($_SESSION['role']!=3){//checks if the user is a committee member
    echo("<script>alert('You do not have permission to access this page');
    window.location.href = 'customerhome.php';</script>");//if the user isn't a committee member they are sent a message saying that they don't have persmission to acess the page and 
    //then sent back to the home page
}

?>

<!DOCTYPE html>
<html>
        
<head>
    
    <title>Manage Accounts</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"><!--links to the bootstrap -->
    <link rel="stylesheet" href="style.css"/><!--links to the external style sheet-->

</head>

<!--creating the navbar-->
<nav class="navbar navbar-fixed-top"><!--fixes the navbar to the top of the page-->
        <div class="container-fluid">
          <ul class="nav navbar-nav">
            <li><a href="loggedouthome.php">Home</a></li>
            <!--the code below provides the links to the different pages-->
            <li><a href="vieworders.php">View Orders</a></li>
            <li><a href="stock.php">Add Stock</a></li>
            <li><a href="generate.php">Generate Barcodes</a></li>
            <li><a href="checkout.php">Checkout System</a></li>
            <li><a href="users.php">Add Users</a></li>
            <li><a href="totals.php">View Totals</a></li>
            <li><a href="uniform.php">Edit/add uniform</a></li>
            <li><a href="emails.php">Send emails</a></li>
            <li><a href="publishnews.php">Publish News</a></li>
            <li class="active"><a href="manageaccounts.php">Manage Accounts</a></li><!--sets this page as the active page so that it appears a different colour in the navbar-->
            <li><a href="logout.php">Log out</a></li>

          </ul>
        </div>
      </nav>

<?php
$stmt=$conn->prepare("SELECT UserID, Forename, Surname, Username, Role FROM Tblusers");//selects every user from the user table
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){//goes through each item that is retreived in turn
    echo("<a href='editaccountdetails.php?id=".$row['UserID']."'>");//creates the link to the edit details page. it also adds the id onto the end which is how the UserID gets to the 
    //next page
    echo("<button>");//creates the button to go to the edit account details page
    echo("Edit account");//displays this text on the button
    echo("</button>");
    echo("</a>");
    //takes the role and converts it into the text format so that it can be displayed
    if ($row['Role']==1){//sets the role to customer if the value retrieved from the database is 1
        $role="Customer";
    }
    elseif ($row['Role']==2){//sets the role to volunteer if it is 2
        $role="Volunteer";
    }
    elseif ($row['Role']==3){//sets the role to commitee member if it is 3
        $role="Committee Member";
    }
    echo($row['Forename'].', '.$row['Surname'].', '.$row['Username'].', '.$role);//prints the details alongside the button so that the user knows which account they are editing
    echo("<br>");//creates a line break between the pages
  }
?>


