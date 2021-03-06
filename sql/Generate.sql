DROP DATABASE IF EXISTS Yago;  -- Deleting the database if it exists
CREATE DATABASE Yago;
USE Yago;

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
  cafName        BIGINT       NOT NULL,
  cafDescription TEXT         NOT NULL,
  cafAddress     VARCHAR(255) NOT NULL,
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

CREATE TABLE COrder(
  orderID   BIGINT    AUTO_INCREMENT,
  orderTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  total     INT       NOT NULL,
  orderedBy BIGINT    NOT NULL,
  PRIMARY KEY(orderID),
  FOREIGN KEY(orderedBy) REFERENCES Customer(custID)
);

CREATE TABLE Suborder(
  subID BIGINT AUTO_INCREMENT,
  quantity INT,
  foodID BIGINT,
  PRIMARY KEY(subID),
  FOREIGN KEY(foodID) REFERENCES Food(foodID)
);

CREATE TABLE Favourite(
  favID BIGINT AUTO_INCREMENT,
  custID BIGINT,
  foodID BIGINT,
  PRIMARY KEY(favID),
  FOREIGN KEY(custID) REFERENCES Customer(custID),
  FOREIGN KEY(foodID) REFERENCES Food(foodID)
);

/*ADD COMMENTS AND REVIEWS LATER*/
