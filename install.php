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
Email VARCHAR(255) NOT NULL,
Pupilname VARCHAR(30) NOT NULL,
Year INT(2) NOT NULL,
Tutor VARCHAR(30) NOT NULL,
HouseID INT(2) NOT NULL,
Paid BOOLEAN NOT NULL,
Usercompleted BOOLEAN NOT NULL, 
Uniformready BOOLEAN NOT NULL,
Completed BOOLEAN NOT NULL,
Online BOOLEAN NOT NULL,
Datecreated DATE NOT NULL,
Datecompleted DATE NULL
)");
$stmt->execute();
$stmt->closeCursor();

//inserting default data into orders table
$stmt = $conn->prepare("INSERT INTO Tblorders(OrderID,Total,UserID,Deliveryoption,AddressLine1,AddressLine2,Postcode,Email,Pupilname,Year,Tutor,HouseID,Paid,Usercompleted,Uniformready,Completed,Online,Datecreated,Datecompleted)VALUES
(NULL,170,1,2,NULL,NULL,NULL,'test@test.com',NULL,NULL,NULL,NULL,1,1,0,0,1,2024-03-20,NULL),
(NULL,124,1,3,NULL,NULL,NULL,NULL,'John Smith',11,'Mr Cunniffe',3,1,1,0,0,1,2024-03-17,NULL),
(NULL,146,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,1,0,2024-02-01,2024-02-01)
");
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


//inserting default data into basket table
$stmt = $conn->prepare("INSERT INTO Tblbasket(OrderID,UniformID,Quantity,New)VALUES
(3,2,2,0),
(3,11,1,0),
(3,8,1,0)
");
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

//inserting default data into online orders table
$stmt = $conn->prepare("INSERT INTO Tblonlineorders(OrderID,TypeID,Quantity)VALUES
(1,2,2),
(1,8,1),
(1,9,3),
(1,5,2),
(2,3,4),
(2,6,1),
(2,7,1)
");
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

$stmt=$conn->prepare("ALTER TABLE tbluniform AUTO_INCREMENT = 10");
$stmt->execute();

//inserting default data into uniform table
$stmt = $conn->prepare("INSERT INTO Tbluniform(UniformID,TypeID,HouseID,Stock)VALUES
(NULL,1,1,4), 
(NULL,1,2,10), 
(NULL,2,1,5), 
(NULL,3,3,2),
(NULL,3,1,9),
(NULL,4,1,0),
(NULL,5,2,3),  
(NULL,6,3,6),
(NULL,7,2,1),
(NULL,8,1,2),
(NULL,9,2,5),
(NULL,10,3,4)
");//inserts all of the default data into the uniform table
$stmt->execute();
$stmt->closeCursor();


//creating type table
$stmt=$conn->prepare("DROP TABLE IF EXISTS Tbltype;
CREATE TABLE Tbltype
(TypeID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Size VARCHAR(10) NOT NULL,
ItemID INT(2) NOT NULL,
Price FLOAT(5,2) NOT NULL
)");
$stmt->execute();
$stmt->closeCursor();

//inserting default data into type table
$stmt = $conn->prepare("INSERT INTO Tbltype(TypeID,Size,ItemID,Price)VALUES
(NULL,'24, 28',1, 33), 
(NULL,'34, 30', 1, 41),
(NULL,'32, 31', 2, 10),
(NULL,'32, 33', 2, 12),
(NULL,'30-32', 3, 13),
(NULL,'34-36', 4, 13),
(NULL,'30', 5, 71),
(NULL,'Standard', 6, 35),
(NULL,'32', 7, 9),
(NULL,'16', 8, 9)
");//inserts all of the default data into the type table
$stmt->execute();
$stmt->closeCursor();


//creating items table
$stmt=$conn->prepare("DROP TABLE IF EXISTS Tblitems;
CREATE TABLE Tblitems
(ItemID INT(2) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Name VARCHAR(30) NOT NULL,
CategoryID INT(1) NOT NULL,
Photo VARCHAR(50) NOT NULL
)");
$stmt->execute();
$stmt->closeCursor();

//inserting default data into items table
$stmt = $conn->prepare("INSERT INTO Tblitems(ItemID,Name,CategoryID,Photo)VALUES
(NULL,'Culottes', 1, 'Images/Culottes.jpg'), 
(NULL,'Trousers', 3, 'Images/Trousers.jpg'),
(NULL,'Culotte Uniform White T-Shirt', 2, 'Images/culottewhitet-shirt.jpg'),
(NULL,'Trouser Uniform White T-Shirt', 4, 'Images/trouserwhitet-shirt.jpg'),
(NULL,'Overcoat', 9, 'Images/overcoat.jpg'),
(NULL,'Rucksack', 10, 'Images/rucksack.jpg'),
(NULL,'Culotte Uniform Pink Shirt', 7, 'Images/culottepinkshirt.jpg'),
(NULL,'Trouser Blue Shirt', 8, 'Images/trouserblueshirt.jpg')
");//inserts all of the default data into the items table
$stmt->execute();
$stmt->closeCursor();



//creating categories table
$stmt=$conn->prepare("DROP TABLE IF EXISTS Tblcategories;
CREATE TABLE Tblcategories
(CategoryID INT(2) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Uniform VARCHAR(20) NOT NULL,
Type VARCHAR(20) NOT NULL,
Year VARCHAR(20) NOT NULL
)");
$stmt->execute();
$stmt->closeCursor();

//inserting default data into categories table
$stmt = $conn->prepare("INSERT INTO Tblcategories(CategoryID,Uniform,Type, Year)VALUES
(NULL,'Culotte','School','All'), 
(NULL,'Culotte','Sport','All'),
(NULL,'Trouser','School','All'),
(NULL,'Trouser','Sport','All'),
(NULL,'Unisex','School','All'),
(NULL,'Unisex','Sport','All'),
(NULL,'Culotte','School','Sixth'),
(NULL,'Trouser','School','Sixth'),
(NULL,'Unisex','School','Sixth'),
(NULL,'Unisex','School','Junior')
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

//inserting default data into house table
$stmt = $conn->prepare("INSERT INTO Tblhouse(HouseID,Name)VALUES
(NULL,'LSS'), 
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



