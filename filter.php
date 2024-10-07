<?php
include_once("connection.php");
session_start();

print_r($_POST);

if ($_POST['Uniform']=="Alluniform" AND $_POST['Type']=="Alltypes" AND $_POST['Year']=="Allyears"){
    echo("Yes");
    $stmt=$conn->prepare("SELECT CategoryID from TblCategories");
    //$stmt->execute();
}

elseif($_POST['Uniform']=="Alluniform" AND $_POST['Type']=="Alltypes" AND $_POST['Year']=="middle"){
    $stmt=$conn->prepare("SELECT CategoryID from TblCategories where Year=:year");
    $stmt->bindParam(':year',"All");
    //$stmt->execute();
}

elseif($_POST['Uniform']=="Alluniform" AND $_POST['Type']=="Alltypes" AND ($_POST['Year']=="Junior" OR $_POST['Year']=="Sixth")){
    $stmt=$conn->prepare("SELECT CategoryID from TblCategories where Year=:year or Year='All'");
    $stmt->bindParam(':year',$_POST['Year']);
    //$stmt->execute();
}

elseif($_POST['Uniform']=="Alluniform" AND $_POST['Year']=="Allyears"){
    $stmt=$conn->prepare("SELECT CategoryID from TblCategories where Type=:type");
    $stmt->bindParam(':type',$_POST['Type']);
    //$stmt->execute();
}

elseif($_POST['Type']=="Alltypes" AND $_POST['Year']=="Allyears"){
    echo("yes");
    $stmt=$conn->prepare("SELECT CategoryID from TblCategories where Uniform=:uniform");
    $stmt->bindParam(':uniform',$_POST['Uniform']);
    //$stmt->execute();
}


elseif($_POST['Year']=="Allyears"){
    $stmt=$conn->prepare("SELECT CategoryID from TblCategories where Uniform=:uniform and Type=:type");
    $stmt->bindParam(':uniform',$_POST['Uniform']);
    $stmt->bindParam(':type',$_POST['Type']);
    //$stmt->execute();
}

elseif($_POST['Type']=="Alltypes"){
    $stmt=$conn->prepare("SELECT CategoryID from TblCategories where Uniform=:uniform and (Year=:year or Year='All')");
    $stmt->bindParam(':uniform',$_POST['Uniform']);
    $stmt->bindParam(':year',$_POST['Year']);
    //$stmt->execute();
}

elseif($_POST['Uniform']=="Alluniform"){
    $stmt=$conn->prepare("SELECT CategoryID from TblCategories where Type=:type and (Year=:year or Year='All')");
    $stmt->bindParam(':type',$_POST['Type']);
    $stmt->bindParam(':year',$_POST['Year']);
    //$stmt->execute();
}

else{
    $stmt=$conn->prepare("SELECT CategoryID from TblCategories where Uniform=:uniform and Type=:type and (Year=:year or Year='All')");
    $stmt->bindparam(':uniform',$_POST['Uniform']);
    $stmt->bindparam(':type',$_POST['Type']);
    $stmt->bindparam(':year',$_POST['Year']);
    //$stmt->execute();
}

$categories=[];

$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
    $categories[]=$row['CategoryID'];
}


$_SESSION['Categories']=$categories;
header("location:shop.php");

?>


