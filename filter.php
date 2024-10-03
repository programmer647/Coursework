<?php
include_once("connection.php");
session_start();

print_r($_POST);

if ($_POST['Uniform']=="Alluniform" AND $_POST['Type']=="Alltypes" AND $_POST['Year']=="All"){
    $stmt=$conn->prepare("SELECT CategoryID from TblCategories");
}

if ($_POST['Uniform']=="Alluniform" AND $_POST['Type']=="Alltypes" AND $_POST['Year']=="middle"){
    $stmt=$conn->prepare("SELECT CategoryID from TblCategories where Uniform=:uniform and Type=:type and Year=:year");
}


$stmt=$conn->prepare("SELECT CategoryID from TblCategories where Uniform=:uniform and Type=:type and Year=:year");
$stmt->bindparam(':uniform',$_POST['Uniform']);
$stmt->bindparam(':type',$_POST['Type']);
$stmt->bindparam(':year',$_POST['Year']);
$stmt->execute();


//create an array of the possible categories, send this back to the page and then only display items from these categories

?>