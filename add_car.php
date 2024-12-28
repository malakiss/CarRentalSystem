<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "carrentalsystem"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $model = $conn->real_escape_string($_POST['model']);
    $year = intval($_POST['year']);
    $plate_number = $conn->real_escape_string($_POST['plate-number']);
    $rental_price = floatval($_POST['rental-price']);
    $color = $conn->real_escape_string($_POST['color']);
    $officeId = intval($_POST['office-id']);
    $status = $conn->real_escape_string($_POST['status']);

    // SQL query to insert the car data
    $sql = "INSERT INTO vehicle (model, year, plateNo, dailyprice, color, officeId, status) 
            VALUES ('$model', $year, '$plate_number', $rental_price, '$color', $officeId, '$status')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Car added successfully!');</script>";
        header("Location: admin.html");
        exit();
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

// Close the connection
$conn->close();
?>
