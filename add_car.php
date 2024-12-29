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
    $statusDate = date('Y-m-d H:i:s'); // Current date
     // Validate plate number: must be exactly 3 digits
     if (!preg_match('/^\d{3}$/', $plate_number)) {
        echo "<script>alert('Plate number must be exactly 3 digits.');</script>";
        echo "<script>window.location.href = 'add_car.html';</script>";
        exit();
    }

    // Insert into vehicle table
    $sql1 = "INSERT INTO vehicle (model, year, plateNo, dailyprice, color, officeId) 
             VALUES ('$model', $year, '$plate_number', $rental_price, '$color', $officeId)";
    
    // Execute first query
    if ($conn->query($sql1) === TRUE) {
        // Insert into vehicle_status table
        $sql2 = "INSERT INTO vehicle_status (plateNo, statusDate, status)
                 VALUES ('$plate_number', '$statusDate', '$status')";
        
        // Execute second query
        if ($conn->query($sql2) === TRUE) {
            echo "<script>alert('Car added successfully!');</script>";
            header("Location: admin.html");
            exit();
        } else {

            echo "<script>alert('Error adding vehicle status: " . $conn->error . "');</script>";
        }
    } else {
        echo '<script>
         alert("  Error adding vehicle: ")
         window.location.href = "add_car.html";
         </script>';
         
    }
}

// Close the connection
$conn->close();
?>

<script>
    function echoAlert(){
        alert('Error adding vehicle: ');
        return false;
    }
    </script>