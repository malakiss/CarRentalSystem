CREATE DATABASE CarRentalSystem;

USE CarRentalSystem;

-- Create the office table first
CREATE TABLE office (
    officeId INT PRIMARY KEY AUTO_INCREMENT,
    city VARCHAR(100),
    contactNumber VARCHAR(15)
);

-- Create the customer table
CREATE TABLE customer (
    customerId INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    password VARCHAR(50),
    email VARCHAR(50),
    phoneNumber VARCHAR(15)
);

-- Create the vehicle table
CREATE TABLE vehicle (
    plateNo INT PRIMARY KEY AUTO_INCREMENT,
    color VARCHAR(50),
    dailyPrice DECIMAL(10,1) NOT NULL,
    year INT,
    model VARCHAR(100) NOT NULL,
    officeId INT,
    FOREIGN KEY (officeId) REFERENCES office(officeId)
);

-- Create the reservation table
CREATE TABLE reservation (
    reserveId INT PRIMARY KEY AUTO_INCREMENT,
    plateNo INT,
    customerId INT,
    reservationDate DATE,
    returnDate DATE,
    pickupDate DATE,
    payment DECIMAL(10,1),
    officeId INT,
    FOREIGN KEY (plateNo) REFERENCES vehicle(plateNo),
    FOREIGN KEY (customerId) REFERENCES customer(customerId),
    FOREIGN KEY (officeId) REFERENCES office(officeId)
);

CREATE TABLE vehicle_status (
    plateNo INT NOT NULL,
    statusDate DATE NOT NULL,
    status ENUM('available', 'out of service', 'rented') NOT NULL,
    PRIMARY KEY (plateNo, statusDate, status),
    FOREIGN KEY (plateNo) REFERENCES vehicle(plateNo)
);