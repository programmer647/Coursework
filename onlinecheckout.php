<?php
include_once("connection.php");
session_start();

$method=$_POST['option'];

$_SESSION['method']=$_POST['option'];

?>
<form action="checkoutprocess.php" method="POST">
<?php
if ($method=="home"){
    ?>
    <form action="checkoutprocess.php" method="POST">
        Address line 1:<input type="text" name="addressline1" required><br>
        Address line 2:<input type="text" name="addressline2" required><br>
        Postcode:<input type="text" name="postcode" required><br>
    <?php
}

elseif ($method=="collect"){
    ?>
    <p>Please enter your email so that the FOLSS team can be in touch to confirm your delivery time</p>
    <form action="checkoutprocess.php" method="POST" required>
        Email address:<input type="text" name="email" required><br>
    <?php
}

elseif($method="boarding"){
    ?>
    <form action="checkoutprocess.php" method="POST">
        Pupil name:<input type="text" name="name" required><br>
        Pupil year group:<input type="text" name="year" required><br>
        Pupil's tutor:<input type="text" name="tutor" required><br>
        House:
        <select name="house" required>
        <option value="">Select house</option>
        <?php
        $stmt=$conn->prepare("SELECT * FROM Tblhouse");
        $stmt->execute();
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            echo("<option value=".$row['HouseID'].">".$row['Name']."</option>");
        }
        ?>
        </select><br>
    <?php
}

?>

<input type="submit" value="Checkout">
</form>




