DROP DATABASE IF EXISTS Schezwan;  -- Deleting the database if it exists
CREATE DATABASE Schezwan;
USE Schezwan;

CREATE TABLE Customer(
  custID   BIGINT       AUTO_INCREMENT,
  fName    VARCHAR(30)  NOT NULL,
  lName    VARCHAR(30)  NOT NULL,
  mobile   VARCHAR(10)  UNIQUE NOT NULL,
  email    VARCHAR(40)  UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY(custID)
);

CREATE TABLE Cafeteria(
  cafID          BIGINT       AUTO_INCREMENT,
  ownFName       VARCHAR(30)  NOT NULL,
  ownLName       VARCHAR(30)  NOT NULL,
  ownEmail       VARCHAR(40)  UNIQUE NOT NULL,
  ownMobile      VARCHAR(10)  UNIQUE NOT NULL,
  cafUserName    VARCHAR(40)  UNIQUE NOT NULL,
  cafPassword    VARCHAR(255) NOT NULL,
  cafName        VARCHAR(255) NOT NULL,
  cafDescription TEXT,
  cafAddress     VARCHAR(255),
  PRIMARY KEY(cafID)
);

CREATE TABLE Food(
  foodID     BIGINT      AUTO_INCREMENT,
  name       VARCHAR(50) NOT NULL,
  cost       INT         NOT NULL,
  rating     FLOAT       NOT NULL,
  numRatings BIGINT      NOT NULL,
  servedBy   BIGINT      NOT NULL,
  PRIMARY KEY(foodID),
  FOREIGN KEY(servedBy) REFERENCES Cafeteria(cafID)
);

CREATE TABLE CafOrder(
  orderID   BIGINT    AUTO_INCREMENT,
  orderTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  orderedBy BIGINT    NOT NULL,
  loaded    BOOLEAN   DEFAULT 0,
  paid      BOOLEAN   DEFAULT 0,
  collected INT       DEFAULT 0,
  quantity  INT       DEFAULT 0,
  prepared  INT       DEFAULT 0,
  PRIMARY KEY(orderID),
  FOREIGN KEY(orderedBy) REFERENCES Customer(custID)
);

CREATE TABLE Suborder(
  subID     BIGINT AUTO_INCREMENT,
  foodID    BIGINT,
  orderID   BIGINT,
  total     INT,
  paid      BOOLEAN   DEFAULT 0,
  collected INT       DEFAULT 0,
  quantity  INT       DEFAULT 0,
  prepared  INT       DEFAULT 0,
  PRIMARY KEY(subID),
  FOREIGN KEY(foodID) REFERENCES Food(foodID),
  FOREIGN KEY(orderID) REFERENCES CafOrder(orderID)
);

CREATE TABLE Favourite(
  favID BIGINT AUTO_INCREMENT,
  custID BIGINT,
  foodID BIGINT,
  PRIMARY KEY(favID),
  FOREIGN KEY(custID) REFERENCES Customer(custID),
  FOREIGN KEY(foodID) REFERENCES Food(foodID)
);