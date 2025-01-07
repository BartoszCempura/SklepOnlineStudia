
CREATE DATABASE SiteDB;
USE SiteDB;

CREATE TABLE Category (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(255) NOT NULL
);

CREATE TABLE Attribute (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(255) NOT NULL
);

CREATE TABLE Product (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    CategoryID INT,
    Name VARCHAR(255) NOT NULL,
    Description TEXT,
    Image VARCHAR(255),
    Quantity INT NOT NULL CHECK (Quantity >= 0),
    Price DECIMAL(10, 2) NOT NULL CHECK (Price >= 0),
    FOREIGN KEY (CategoryID) REFERENCES Category(ID)
);

CREATE TABLE Product_Attribute (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    ProductID INT,
    AttributeID INT,
    Value VARCHAR(255),
    FOREIGN KEY (ProductID) REFERENCES Product(ID),
    FOREIGN KEY (AttributeID) REFERENCES Attribute(ID)
);

CREATE TABLE Transaction (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    CartID INT,
    Status VARCHAR(50) NOT NULL CHECK (Status IN ('Pending', 'Completed', 'Cancelled')),
    Date DATETIME
);


CREATE DATABASE ClientDB;
USE ClientDB;

CREATE TABLE `User` (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Login VARCHAR(255) UNIQUE,
    Password VARCHAR(255) NOT NULL,
    First_Name VARCHAR(255),
    Last_Name VARCHAR(255),
    Email VARCHAR(255) UNIQUE CHECK (Email LIKE '%@%.%'),
    Phone_Number VARCHAR(20) CHECK (Phone_Number REGEXP '^[0-9]{9}$')  -- 9 digit phone number
);

CREATE TABLE Address (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    Street VARCHAR(255),
    Number VARCHAR(10),
    Country VARCHAR(100),
    City VARCHAR(100),
    Zip_Code VARCHAR(20) CHECK (Zip_Code LIKE '%[0-9a-zA-Z -]%'), 
    FOREIGN KEY (UserID) REFERENCES User(ID)
);

CREATE TABLE Cart (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    Total DECIMAL(10, 2) NOT NULL DEFAULT 0 CHECK (Total >= 0),
    FOREIGN KEY (UserID) REFERENCES User(ID)
);

CREATE TABLE Cart_Product (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    CartID INT,
    ProductID INT,
    Quantity INT NOT NULL CHECK (Quantity > 0),
    FOREIGN KEY (CartID) REFERENCES Cart(ID),
    FOREIGN KEY (ProductID) REFERENCES SiteDB.Product(ID)
);

CREATE TABLE WishList (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    ProductID INT,
    FOREIGN KEY (UserID) REFERENCES User(ID),
    FOREIGN KEY (ProductID) REFERENCES SiteDB.Product(ID)
);

USE SiteDB 
GO 

ALTER TABLE Transaction
ADD CONSTRAINT fk_cart FOREIGN KEY (CartID) REFERENCES ClientDB.Cart(ID);
