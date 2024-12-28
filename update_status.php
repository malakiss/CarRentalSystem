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
    $plate_number = intval($_POST['plate-number']);
    $status = $conn->real_escape_string($_POST['status']);

    // SQL query to update the car status
    $sql = "UPDATE vehicle SET status = '$status' WHERE plateNo = '$plate_number'";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "<p>Car updated successfully!</p>";
        header("Location: admin.html");
        exit();
    } else {
        echo "<script>alert('Error: " . $conn->error . "')</script>";
    }
}

// Close the connection
$conn->close();
?>
