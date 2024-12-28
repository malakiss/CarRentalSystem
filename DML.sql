-- Insert data into the office table
INSERT INTO office (city, contactNumber) VALUES 
('New York', '123-456-7890'),
('Los Angeles', '987-654-3210'),
('Chicago', '555-123-4567');

-- Insert data into the customer table
INSERT INTO customer (name, password, email, phoneNumber) VALUES 
('Alice Johnson', 'alice123', 'alice@example.com', '111-222-3333'),
('Bob Smith', 'bob456', 'bob@example.com', '444-555-6666'),
('Charlie Brown', 'charlie789', 'charlie@example.com', '777-888-9999');

-- Insert data into the vehicle table
INSERT INTO vehicle (color, dailyPrice, year, model, officeId) VALUES 
('Red', 50.0, 2020, 'Toyota Corolla', 1),
('Blue', 70.5, 2021, 'Honda Civic', 2),
('Black', 100.0, 2019, 'BMW 3 Series', 3);

-- Insert data into the reservation table
INSERT INTO reservation (plateNo, customerId, reservationDate, returnDate, pickupDate, payment, officeId) VALUES 
(1, 1, '2024-12-20', '2024-12-25', '2024-12-21', 250.0, 1),
(2, 2, '2024-12-22', '2024-12-28', '2024-12-23', 423.0, 2),
(3, 3, '2024-12-23', '2024-12-30', '2024-12-24', 700.0, 3);

-- Insert data into the vehicle_status table
INSERT INTO vehicle_status (plateNo, statusDate, status) VALUES 
(1, '2024-12-20', 'rented'),
(2, '2024-12-22', 'rented'),
(3, '2024-12-23', 'available');

-- Insert more data into the office table
INSERT INTO office (city, contactNumber) VALUES 
('San Francisco', '888-999-0000'),
('Miami', '222-333-4444'),
('Houston', '666-777-8888');

-- Insert more data into the customer table
INSERT INTO customer (name, password, email, phoneNumber) VALUES 
('Diana Prince', 'wonder123', 'diana@example.com', '123-987-6543'),
('Bruce Wayne', 'batman456', 'bruce@example.com', '321-654-9870'),
('Clark Kent', 'superman789', 'clark@example.com', '456-789-1234'),
('Lois Lane', 'lois123', 'lois@example.com', '654-321-9876');

-- Insert more data into the vehicle table
INSERT INTO vehicle (color, dailyPrice, year, model, officeId) VALUES 
('White', 60.0, 2022, 'Nissan Altima', 4),
('Silver', 80.0, 2020, 'Ford Escape', 5),
('Gray', 95.0, 2021, 'Tesla Model 3', 6),
('Green', 40.0, 2018, 'Chevrolet Spark', 4),
('Yellow', 120.0, 2022, 'Lamborghini Huracan', 5);

-- Insert more data into the reservation table
INSERT INTO reservation (plateNo, customerId, reservationDate, returnDate, pickupDate, payment, officeId) VALUES 
(4, 4, '2024-12-24', '2024-12-29', '2024-12-25', 300.0, 4),
(5, 5, '2024-12-26', '2025-01-01', '2024-12-27', 560.0, 5),
(6, 6, '2024-12-28', '2025-01-03', '2024-12-29', 475.0, 6),
(7, 2, '2024-12-29', '2025-01-02', '2024-12-30', 160.0, 4),
(8, 1, '2024-12-30', '2025-01-04', '2024-12-31', 600.0, 5);

-- Insert more data into the vehicle_status table
INSERT INTO vehicle_status (plateNo, statusDate, status) VALUES 
(4, '2024-12-24', 'rented'),
(5, '2024-12-26', 'rented'),
(6, '2024-12-28', 'available'),
(7, '2024-12-29', 'available'),
(8, '2024-12-30', 'out of service');

INSERT INTO vehicle_status (plateNo, statusDate, status) VALUES 
(4, '2024-12-26', 'available'),
(5, '2024-12-27', 'out of service');

