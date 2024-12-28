-- Populate the `office` table
INSERT INTO office (city, contactNumber) VALUES
('New York', '212-555-1234'),
('Los Angeles', '310-555-5678'),
('Chicago', '312-555-8765'),
('Houston', '713-555-4321'),
('Miami', '305-555-6543');

-- Populate the `customer` table
INSERT INTO customer (name, password, email, phoneNumber) VALUES
('John Doe', '123', 'john.doe@example.com', '555-123-4567'),
('Jane Smith', '123', 'jane.smith@example.com', '555-234-5678'),
('Alice Johnson', '123', 'alice.johnson@example.com', '555-345-6789'),
('Bob Brown', '123', 'bob.brown@example.com', '555-456-7890'),
('Eve Adams', '123', 'eve.adams@example.com', '555-567-8901');

-- Note: Replace hashed passwords with your own generated bcrypt hashes for testing.

-- Populate the `vehicle` table
INSERT INTO vehicle (color, dailyPrice, year, model, status, officeId) VALUES
('Red', 49.9, 2020, 'Toyota Corolla', 'available', 1),
('Blue', 59.9, 2019, 'Honda Civic', 'rented', 2),
('Black', 79.9, 2021, 'Ford Explorer', 'available', 3),
('White', 99.9, 2022, 'Tesla Model 3', 'out of service', 4),
('Gray', 39.9, 2018, 'Chevrolet Malibu', 'available', 5),
('Red', 69.9, 2021, 'BMW 3 Series', 'available', 1),
('Blue', 89.9, 2020, 'Mercedes-Benz C-Class', 'rented', 2),
('Black', 99.9, 2023, 'Audi A4', 'available', 3),
('White', 29.9, 2017, 'Hyundai Elantra', 'available', 4),
('Gray', 49.9, 2020, 'Kia Optima', 'available', 5);

-- Populate the `reservation` table
INSERT INTO reservation (plateNo, customerId, reservationDate, returnDate, pickupDate, payment, officeId) VALUES
(2, 1, '2024-12-01 09:00:00', '2024-12-05 18:00:00', '2024-12-01 09:30:00', 299.5, 2),
(7, 2, '2024-12-02 10:00:00', '2024-12-04 16:00:00', '2024-12-02 11:00:00', 179.8, 2),
(8, 3, '2024-12-03 14:00:00', '2024-12-07 10:00:00', '2024-12-03 15:00:00', 399.6, 3),
(6, 4, '2024-12-04 08:00:00', '2024-12-06 19:00:00', '2024-12-04 08:30:00', 239.7, 1),
(9, 5, '2024-12-05 12:00:00', '2024-12-08 15:00:00', '2024-12-05 12:30:00', 149.5, 4);
