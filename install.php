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

//creating orders table
$stmt=$conn->prepare("DROP TABLE IF EXISTS Tblorders;
CREATE TABLE Tblorders
(Total FLOAT (5,2) NOT NULL,
UserID INT(6) NOT NULL,
Deliveryoption TINYINT(1) NOT NULL,
AddressLine1 VARCHAR(40) NOT NULL,
AddressLine2 VARCHAR (30) NOT NULL,
Postcode VARCHAR (7) NOT NULL,
Paid BOOLEAN ,
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
Quantity INT(2) NOT NULL
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
$stmt=$conn->prepare("DROP TABLE IF EXISTS Tblonlineorders;
CREATE TABLE Tblonlineorders
(UniformID INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
TypeID VARCHAR(2) NOT NULL,
HouseID INT(2) NOT NULL,
Stock INT(2) NOT NULL
)");
$stmt->execute();
$stmt->closeCursor();

//creating type table
$stmt=$conn->prepare("DROP TABLE IF EXISTS Tbltype;
CREATE TABLE Tbltype
(Size VARCHAR(5) NOT NULL,
TypeID INT(2) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Name VARCHAR(20) NOT NULL,
Price FLOAT(5,2) NOT NULL,
CategoryID INT(2) NOT NULL,
Photo VARCHAR(50) NOT NULL,
New BOOLEAN NOT NULL
)");
$stmt->execute();
$stmt->closeCursor();

//creating categories table
$stmt=$conn->prepare("DROP TABLE IF EXISTS Tblcategories;
CREATE TABLE Tblcategories
(Gender VARCHAR(2) NOT NULL,
CategoryID VARCHAR(2) NOT NULL,
Type VARCHAR(20) NOT NULL
)");
$stmt->execute();
$stmt->closeCursor();

//creating house table
$stmt=$conn->prepare("DROP TABLE IF EXISTS Tblhouse;
CREATE TABLE Tblhouse
(HouseID INT(2) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Hsm VARCHAR(40) NOT NULL,
Matron VARCHAR(40) NOT NULL,
Name VARCHAR(20) NOT NULL
)");
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