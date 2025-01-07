
CREATE DATABASE SiteDB;
USE SiteDB;

CREATE TABLE Category (
  ID INT PRIMARY KEY AUTO_INCREMENT,
  Name varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE Attribute (
  ID INT PRIMARY KEY AUTO_INCREMENT,
  Name varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE Product (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    CategoryID INT,
    Name VARCHAR(255) NOT NULL,
    Description TEXT,
    Image VARCHAR(255),
    Quantity INT NOT NULL CHECK (Quantity >= 0),
    Price DECIMAL(10, 2) NOT NULL CHECK (Price >= 0),
    FOREIGN KEY (CategoryID) REFERENCES Category(ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE Product_Attribute (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    ProductID INT,
    AttributeID INT,
    Value VARCHAR(255),
    FOREIGN KEY (ProductID) REFERENCES Product(ID),
    FOREIGN KEY (AttributeID) REFERENCES Attribute(ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE Transaction (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    CartID INT,
    UserID INT,
    DeliveryAddress VARCHAR(255),
    DeliveryMethod VARCHAR(50) NOT NULL CHECK (DeliveryMethod IN ('InPost', 'UPS')),
    Status VARCHAR(50) NOT NULL CHECK (Status IN ('Pending', 'Completed', 'Cancelled')),
    Date DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE Transaction_Products (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    TransactionID INT, 
    ProductID INT,
    Quantity INT,
    Price DECIMAL(10, 2),
    FOREIGN KEY (TransactionID) REFERENCES Transaction(ID),
    FOREIGN KEY (ProductID) REFERENCES Product(ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE Payment (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    TransactionID INT,
    PaymentMethod VARCHAR(50) NOT NULL CHECK (PaymentMethod IN ('PayPal', 'Card', 'Gift Card')),
    Amount DECIMAL(10, 2),
    Status VARCHAR(50) NOT NULL CHECK (Status IN ('Pending', 'Completed', 'Cancelled')),
    PaymentDate DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (TransactionID) REFERENCES Transaction(ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE DATABASE ClientDB;
USE ClientDB;

CREATE TABLE User (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Login VARCHAR(255) UNIQUE,
    Password VARCHAR(255) NOT NULL,
    First_Name VARCHAR(255),
    Last_Name VARCHAR(255),
    Email VARCHAR(255) UNIQUE CHECK (Email LIKE '%@%.%'),
    Phone_Number VARCHAR(20) CHECK (Phone_Number REGEXP '^[0-9]{9}$')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE Address (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    CompanyName VARCHAR(255),
    Nip VARCHAR(50),
    Street VARCHAR(255),
    Number VARCHAR(10),
    Country VARCHAR(100),
    City VARCHAR(100),
    Zip_Code VARCHAR(20) CHECK (Zip_Code LIKE '%[0-9a-zA-Z -]%'), 
    FOREIGN KEY (UserID) REFERENCES User(ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE Cart (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    Total DECIMAL(10, 2) NOT NULL DEFAULT 0 CHECK (Total >= 0),
    FOREIGN KEY (UserID) REFERENCES User(ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE Cart_Products (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    CartID INT,
    ProductID INT,
    Quantity INT NOT NULL CHECK (Quantity > 0),
    Price DECIMAL(10, 2),
    FOREIGN KEY (CartID) REFERENCES Cart(ID),
    FOREIGN KEY (ProductID) REFERENCES SiteDB.Product(ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE WishList (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    ProductID INT,
    FOREIGN KEY (UserID) REFERENCES User(ID),
    FOREIGN KEY (ProductID) REFERENCES SiteDB.Product(ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

