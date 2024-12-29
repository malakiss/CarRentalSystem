use carrentalsystem;
-- Inserting data into the office table
INSERT INTO office (city, contactNumber)
VALUES 
('New York', '123-456-7890'),
('Los Angeles', '234-567-8901'),
('Chicago', '345-678-9012'),
('Miami', '456-789-0123'),
('San Francisco', '567-890-1234');

-- Inserting data into the customer table
INSERT INTO customer (name, password, email, phoneNumber)
VALUES
('John Doe', 'password123', 'johndoe@example.com', '111-222-3333'),
('Jane Smith', 'password456', 'janesmith@example.com', '222-333-4444'),
('David Johnson', 'password789', 'davidj@example.com', '333-444-5555'),
('Emily Davis', 'password321', 'emilydavis@example.com', '444-555-6666'),
('Michael Brown', 'password654', 'michaelbrown@example.com', '555-666-7777');

-- Inserting data into the vehicle table
INSERT INTO vehicle (color, dailyPrice, year, model, officeId)
VALUES 
('Red', 49.99, 2022, 'Toyota Corolla', 1),
('Blue', 59.99, 2021, 'Honda Civic', 2),
('Black', 79.99, 2023, 'BMW 320i', 3),
('White', 89.99, 2022, 'Mercedes Benz E-Class', 4),
('Silver', 69.99, 2021, 'Audi A4', 5);

-- Inserting data into the reservation table
INSERT INTO reservation (plateNo, customerId, reservationDate, returnDate, pickupDate, payment, officeId)
VALUES
(1, 1, '2024-12-01 10:00:00', '2024-12-07 10:00:00', '2024-12-01 12:00:00', 349.95, 1),
(2, 2, '2024-12-02 14:00:00', '2024-12-05 14:00:00', '2024-12-02 16:00:00', 179.95, 2),
(3, 3, '2024-12-03 09:00:00', '2024-12-08 09:00:00', '2024-12-03 11:00:00', 399.95, 3),
(4, 4, '2024-12-04 10:30:00', '2024-12-10 10:30:00', '2024-12-04 13:00:00', 539.95, 4),
(5, 5, '2024-12-05 11:00:00', '2024-12-09 11:00:00', '2024-12-05 14:00:00', 279.95, 5);

-- Inserting data into the vehicle_status table
INSERT INTO vehicle_status (plateNo, statusDate, status)
VALUES
(1, '2024-12-01 10:00:00', 'rented'),
(2, '2024-12-02 14:00:00', 'rented'),
(3, '2024-12-03 09:00:00', 'available'),
(4, '2024-12-04 10:30:00', 'rented'),
(5, '2024-12-05 11:00:00', 'available'),
(1, '2024-12-07 10:00:00', 'available'),
(2, '2024-12-05 14:00:00', 'available'),
(3, '2024-12-08 09:00:00', 'available'),
(4, '2024-12-10 10:30:00', 'available'),
(5, '2024-12-09 11:00:00', 'available');
