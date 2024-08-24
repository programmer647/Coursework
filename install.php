<?php
//connecting to the database using the connection file
include ("connection.php");

//creating users table
$stmt=$conn->prepare("DROP TABLE IF EXISTS Tblusers;
CREATE TABLE Tblusers
(UserID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Forename VARCHAR(20) NOT NULL,
Surname VARCHAR(20) NOT NULL,
Username VARCHAR(20) NOT NULL,
Password VARCHAR (200) NOT NULL,
Role TINYINT(1))");
$stmt->execute();
$stmt->closeCursor();
$hashed_password = password_hash("password", PASSWORD_DEFAULT); //sets the default password and hashes it before it is inserted into the table
$stmt = $conn->prepare("INSERT INTO Tblusers(UserID,Forename,Surname,Username,Password,Role)VALUES
(NULL,'Sophie','Bourne','Sbourne',:hp,1), 
(NULL,'Christina','Wood','Secretary',:hp,3),
(NULL,'Jane','Smith','Jsmith',:hp,2)
");//inserts all of the default data into the users table
$stmt->bindParam(':hp', $hashed_password); //makes the password in the default data the hashed password
$stmt->execute();
$stmt->closeCursor();


//creating orders table
$stmt=$conn->prepare("DROP TABLE IF EXISTS Tblorders;
CREATE TABLE Tblorders
(OrderID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Total FLOAT (5,2) NOT NULL,
UserID INT(6) NOT NULL,
Deliveryoption TINYINT(1) NOT NULL,
AddressLine1 VARCHAR(40) NOT NULL,
AddressLine2 VARCHAR (30) NOT NULL,
Postcode VARCHAR (7) NOT NULL,
Paid BOOLEAN NOT NULL,
Uniformready BOOLEAN,
Completed BOOLEAN NOT NULL,
Datecreated DATE NOT NULL,
Datecompleted DATE Null
)");
$stmt->execute();
$stmt->closeCursor();

//creating basket table
$stmt=$conn->prepare("DROP TABLE IF EXISTS Tblbasket;
CREATE TABLE Tblbasket
(OrderID INT(4) NOT NULL,
UniformID VARCHAR(3) NOT NULL,
Quantity INT(2) NOT NULL,
New VARCHAR(10) NOT NULL
)");
$stmt->execute();
$stmt->closeCursor();

//creating online orders table
$stmt=$conn->prepare("DROP TABLE IF EXISTS Tblonlineorders;
CREATE TABLE Tblonlineorders
(OrderID INT(4) NOT NULL,
TypeID VARCHAR(2) NOT NULL,
Quantity INT(2) NOT NULL
)");
$stmt->execute();
$stmt->closeCursor();


//creating uniform table
$stmt=$conn->prepare("DROP TABLE IF EXISTS Tbluniform;
CREATE TABLE Tbluniform
(UniformID INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
TypeID VARCHAR(2) NOT NULL,
HouseID INT(2) NOT NULL,
Stock INT(2) NOT NULL
)");
$stmt->execute();
$stmt->closeCursor();
$stmt = $conn->prepare("INSERT INTO Tbluniform(UniformID,TypeID,HouseID,Stock)VALUES
(NULL,1,1,4), 
(NULL,1,2,10), 
(NULL,2,1,5), 
(NULL,3,3,2),
(NULL,3,1,9),
(NULL,5,2,3),  
(NULL,6,3,6)
");//inserts all of the default data into the uniform table
$stmt->execute();
$stmt->closeCursor();




//creating type table
$stmt=$conn->prepare("DROP TABLE IF EXISTS Tbltype;
CREATE TABLE Tbltype
(TypeID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Size1 VARCHAR(10) NOT NULL,
Size2 VARCHAR(10) NOT NULL,
ItemID INT(2) NOT NULL,
Price FLOAT(5,2) NOT NULL,
New BOOLEAN NOT NULL
)");
$stmt->execute();
$stmt->closeCursor();
$stmt = $conn->prepare("INSERT INTO Tbltype(TypeID,Size1,Size2,ItemID,Price,New)VALUES
(NULL,'24','28',1, 33,0), 
(NULL,'34','30', 1, 41,0),
(NULL,'32','31', 2, 10, 0),
(NULL,'32','33', 2, 12, 0),
(NULL,'30-32','', 3, 13, 0),
(NULL,'34-36','', 3, 13, 0)
");//inserts all of the default data into the type table
$stmt->execute();
$stmt->closeCursor();


//creating items table
$stmt=$conn->prepare("DROP TABLE IF EXISTS Tblitems;
CREATE TABLE Tblitems
(ItemID INT(2) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Name VARCHAR(20) NOT NULL,
CategoryID INT(1) NOT NULL,
Photo VARCHAR(50) NOT NULL
)");
$stmt->execute();
$stmt->closeCursor();
$stmt = $conn->prepare("INSERT INTO Tblitems(ItemID,Name,CategoryID,Photo)VALUES
(NULL,'Culottes', 1, 'Images/Culottes.jpg'), 
(NULL,'Trousers', 3, 'Images/Trousers.jpg'),
(NULL,'White T-Shirt', 2, 'Images/culottewhitet-shirt.jpg'),
(NULL,'White T-Shirt', 4, 'Images/trouserwhitet-shirt.jpg')
");//inserts all of the default data into the type table
$stmt->execute();
$stmt->closeCursor();





//creating categories table
$stmt=$conn->prepare("DROP TABLE IF EXISTS Tblcategories;
CREATE TABLE Tblcategories
(CategoryID INT(2) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Uniform VARCHAR(20) NOT NULL,
Type VARCHAR(20) NOT NULL
)");
$stmt->execute();
$stmt->closeCursor();
$stmt = $conn->prepare("INSERT INTO Tblcategories(CategoryID,Uniform,Type)VALUES
(NULL,'Culotte','School'), 
(NULL,'Culotte','Sport'),
(NULL,'Trouser','School'),
(NULL,'Trouser','Sport'),
(NULL,'Unisex','School'),
(NULL,'Unisex','Sport')
");//inserts all of the default data into the categories table
$stmt->execute();
$stmt->closeCursor();




//creating house table
$stmt=$conn->prepare("DROP TABLE IF EXISTS Tblhouse;
CREATE TABLE Tblhouse
(HouseID INT(2) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Name VARCHAR(20) NOT NULL
)");
$stmt->execute();
$stmt->closeCursor(); 
$stmt = $conn->prepare("INSERT INTO Tblhouse(HouseID,Name)VALUES
(NULL,'FOLSS'), 
(NULL,'Dryden'),
(NULL,'Laundimer')
");//inserts all of the default data into the houses table
$stmt->execute();
$stmt->closeCursor();



//creating email table
$stmt=$conn->prepare("DROP TABLE IF EXISTS Tblemail;
CREATE TABLE Tblemail
(EmailID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Address VARCHAR(30) NOT NULL
)");
$stmt->execute();
$stmt->closeCursor();


?>