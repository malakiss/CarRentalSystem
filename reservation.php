<?php
session_start();
include 'connection.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from the form
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];

    // Validate dates
    $current_date = date('Y-m-d');
    if ($from_date < $current_date || $to_date < $from_date) {
        echo "Invalid date range. Please ensure 'From Date' is today or later and 'To Date' is after 'From Date'.";
        exit;
    }

    if (!isset($_GET['plateNo']) || empty($_GET['plateNo'])) {
        die("Car plate number is missing. Please go back and select a car.");
    }
    $plateNo = htmlspecialchars($_GET['plateNo']);
    

    // Get customer info from SESSION
    if (!isset($_SESSION['customer_id']) || !isset($_SESSION['name'])) {
        echo "Customer information is missing. Please log in.";
        exit;
    }
    $customer_id = $_SESSION['customer_id'];
    $customer_name = $_SESSION['name'];

    // Check car availability
    $query = "
        SELECT COUNT(*) AS conflicts 
        FROM reservation
        WHERE plateNo = ? AND (
            (pickupDate BETWEEN ? AND ?) OR
            (returnDate BETWEEN ? AND ?) OR
            (? BETWEEN pickupDate AND returnDate) OR
            (? BETWEEN pickupDate AND returnDate)
        )
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issssss", $plateNo, $from_date, $to_date, $from_date, $to_date, $from_date, $to_date);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['conflicts'] > 0) {
        echo "The car is not available during the selected dates.";
        exit;
    }

        // Get the daily price and officeId of the vehicle
    $query = "SELECT dailyPrice, officeId FROM vehicle WHERE plateNo = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $plateNo);
    $stmt->execute();
    $result = $stmt->get_result();
    $vehicle = $result->fetch_assoc();

    if (!$vehicle) {
        echo "Vehicle not found.";
        exit;
    }

    $daily_price = $vehicle['dailyPrice'];
    $office_id = $vehicle['officeId']; // Retrieve officeId

    // Calculate total payment
    $date_diff = strtotime($to_date) - strtotime($from_date);
    $days = ceil($date_diff / (60 * 60 * 24));
    $total_payment = $days * $daily_price;

    // Insert reservation into the database
    // Insert reservation into the database
    $query = "
    INSERT INTO reservation (plateNo, customerId, reservationDate, returnDate, pickupDate, payment, officeId)
    VALUES (?, ?, ?, ?, ?, ?, ?)
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iisssdi", $plateNo, $customer_id, $from_date, $to_date, $from_date, $total_payment, $office_id);

   
if ($stmt->execute()) {
    // Reservation successful
    echo "Reservation successful! Total payment: $" . number_format($total_payment, 2);

    // Insert into the status table
    $query_status_rented = "INSERT INTO vehicle_status (plateNo, statusDate, status) VALUES (?, ?, ?)";
    $status_rented = "rented";

    $stmt_status_rented = $conn->prepare($query_status_rented);
    $stmt_status_rented->bind_param("iss", $plateNo, $from_date, $status_rented);

    if ($stmt_status_rented->execute()) {
        echo " Status updated: Rented on " . htmlspecialchars($from_date) . ".";
    } else {
        echo " Failed to update status for rented date.";
    }

    $query_status_available = "INSERT INTO vehicle_status (plateNo, statusDate, status) VALUES (?, ?, ?)";
    $status_available = "available";

    $stmt_status_available = $conn->prepare($query_status_available);
    $stmt_status_available->bind_param("iss", $plateNo, $to_date, $status_available);

    if ($stmt_status_available->execute()) {
        echo " Status updated: Available on " . htmlspecialchars($to_date) . ".";
    } else {
        echo " Failed to update status for available date.";
    }
} else {
    echo "Failed to make a reservation. Please try again.";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Reservation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Reserve Your Car</h1>
        <form  method="POST" class="reservation-form">
            <div class="form-group">
                <label for="from_date">From Date</label>
                <input type="date" id="from_date" name="from_date" required>
            </div>
            <div class="form-group">
                <label for="to_date">To Date</label>
                <input type="date" id="to_date" name="to_date" required>
            </div>
            <button type="submit" class="submit-button">Reserve</button>
        </form>
    </div>
</body>
</html>
  