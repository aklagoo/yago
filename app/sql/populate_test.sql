USE schezwan;

-- Clear all data in older tables
TRUNCATE Customer;
TRUNCATE Cafeteria;
TRUNCATE Food;
TRUNCATE CafOrder;
TRUNCATE Suborder;
TRUNCATE FAVOURITE;

-- Add new data
INSERT INTO Customer(fName, lName, mobile, email, password) VALUES('Archan', 'Lagoo', '9969933467', 'aklagoo@gmail.com', 'aaa');
INSERT INTO Cafeteria
(ownFName, ownLName, ownEmail, ownMobile, cafUserName, cafPassword, cafName) VALUES(
'Aman', 'Movement', 'aman@somaiya.edu', '9969933467','amanbaba','aaa', 'KJSIEIT');
INSERT INTO Food(name, cost, rating, numRatings, servedBy) VALUES('Samosa', 12, 4.5, 13, 1);
INSERT INTO CafOrder(orderedBy, quantity) VALUES(1, 1);
INSERT INTO Suborder(quantity, foodID, orderID) VALUES(1,1,1);