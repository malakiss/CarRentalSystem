-- Insert into the office table
INSERT INTO office (city, contactNumber) VALUES ('New York', '123-456-7890');
INSERT INTO office (city, contactNumber) VALUES ('Los Angeles', '987-654-3210');
INSERT INTO office (city, contactNumber) VALUES ('Chicago', '111-222-3333');
INSERT INTO office (city, contactNumber) VALUES ('Houston', '444-555-6666');

-- Insert into the customer table
INSERT INTO customer (name, password, email, phoneNumber) VALUES ('John Doe', 'password123', 'john@example.com', '555-1234');
INSERT INTO customer (name, password, email, phoneNumber) VALUES ('Jane Smith', 'securepass', 'jane@example.com', '555-5678');
INSERT INTO customer (name, password, email, phoneNumber) VALUES ('Alice Johnson', 'mypassword', 'alice@example.com', '555-2468');
INSERT INTO customer (name, password, email, phoneNumber) VALUES ('Bob Brown', '123secure', 'bob@example.com', '555-1357');

-- Insert into the vehicle table
INSERT INTO vehicle (plateNo, color, dailyPrice, year, model, officeId) 
VALUES (123, 'Red', 50.0, 2020, 'Toyota Camry', 1);

INSERT INTO vehicle (plateNo, color, dailyPrice, year, model, officeId) 
VALUES (456, 'Blue', 60.0, 2021, 'Honda Accord', 2);

INSERT INTO vehicle (plateNo, color, dailyPrice, year, model, officeId) 
VALUES (789, 'Black', 55.0, 2019, 'Ford Fusion', 3);

INSERT INTO vehicle (plateNo, color, dailyPrice, year, model, officeId) 
VALUES (234, 'White', 70.0, 2022, 'Chevrolet Malibu', 4);

INSERT INTO vehicle (plateNo, color, dailyPrice, year, model, officeId) 
VALUES (567, 'Gray', 45.0, 2020, 'Hyundai Elantra', 1);

-- Insert into the vehicle_status table
INSERT INTO vehicle_status (plateNo, statusDate, status) 
VALUES (123, '2024-12-28 09:00:00', 'available');

INSERT INTO vehicle_status (plateNo, statusDate, status) 
VALUES (456, '2024-12-28 10:00:00', 'rented');

INSERT INTO vehicle_status (plateNo, statusDate, status) 
VALUES (789, '2024-12-28 11:00:00', 'available');

INSERT INTO vehicle_status (plateNo, statusDate, status) 
VALUES (234, '2024-12-28 12:00:00', 'out of service');

INSERT INTO vehicle_status (plateNo, statusDate, status) 
VALUES (567, '2024-12-28 13:00:00', 'available');

-- Insert into the reservation table
INSERT INTO reservation (plateNo, customerId, reservationDate, returnDate, pickupDate, payment, officeId) 
VALUES (123, 1, '2024-12-01 08:00:00', '2024-12-10 18:00:00', '2024-12-01 09:00:00', 500.0, 1);

INSERT INTO reservation (plateNo, customerId, reservationDate, returnDate, pickupDate, payment, officeId) 
VALUES (456, 2, '2024-12-15 08:00:00', '2024-12-20 18:00:00', '2024-12-15 09:00:00', 300.0, 2);

INSERT INTO reservation (plateNo, customerId, reservationDate, returnDate, pickupDate, payment, officeId) 
VALUES (789, 3, '2024-12-05 10:00:00', '2024-12-15 16:00:00', '2024-12-05 11:00:00', 400.0, 3);

INSERT INTO reservation (plateNo, customerId, reservationDate, returnDate, pickupDate, payment, officeId) 
VALUES (234, 4, '2024-12-08 09:30:00', '2024-12-18 14:00:00', '2024-12-08 10:00:00', 700.0, 4);

INSERT INTO reservation (plateNo, customerId, reservationDate, returnDate, pickupDate, payment, officeId) 
VALUES (567, 1, '2024-12-22 09:00:00', '2024-12-29 17:00:00', '2024-12-22 10:00:00', 315.0, 1);
