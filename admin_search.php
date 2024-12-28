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
echo "<style>
table {
    width: 100%;
    border-collapse: collapse;
    background-color: #f9f9f9;
    color: #333;
    font-family: Arial, sans-serif;
}
th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}
th {
    background-color: #4CAF50;
    color: white;
}
tr:nth-child(even) {
    background-color: #f2f2f2;
}
tr:hover {
    background-color: #ddd;
}
</style>";

// Initialize variables for search inputs
$carInfo = isset($_GET['car-info']) ? $conn->real_escape_string($_GET['car-info']) : '';
$customerInfo = isset($_GET['customer-info']) ? $conn->real_escape_string($_GET['customer-info']) : '';
$reservationDay = isset($_GET['reservation-day']) ? $conn->real_escape_string($_GET['reservation-day']) : '';

// Construct the SQL query
if (!empty($carInfo) ) {
$params = [];
$types = "";
$query = "SELECT 
            v.plateNo, v.model, v.color, v.dailyPrice, v.year, v.status,
            c.customerId, c.name AS customerName, c.email, c.phoneNumber,
            r.reserveId, r.reservationDate, r.pickupDate, r.returnDate, r.payment
          FROM vehicle v
          LEFT JOIN reservation r ON v.plateNo = r.plateNo
          LEFT JOIN customer c ON r.customerId = c.customerId
          WHERE 1=1";

$carInfoParts = explode(' ', $carInfo);
$query .= " AND (";
$carConditions = [];
foreach ($carInfoParts as $part) {
    $carConditions[] = "(v.model LIKE ? OR v.plateNo LIKE ?)";
    $params[] = "%$part%";
    $params[] = "%$part%";
    $types .= "ss";
}
$query .= implode(" OR ", $carConditions) . ")";
$stmt = $conn->prepare($query);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
 if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr>
            <th>Plate Number</th>
            <th>Model</th>
            <th>Color</th>
            <th>Daily Price</th>
            <th>Year</th>
            <th>Status</th>
            <th>Customer ID</th>
            <th>Customer Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Reservation ID</th>
            <th>Reservation Date</th>
            <th>Pickup Date</th>
            <th>Return Date</th>
            <th>Payment</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['plateNo']}</td>
                <td>{$row['model']}</td>
                <td>{$row['color']}</td>
                <td>{$row['dailyPrice']}</td>
                <td>{$row['year']}</td>
                <td>{$row['status']}</td>
                <td>{$row['customerId']}</td>
                <td>{$row['customerName']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phoneNumber']}</td>
                <td>{$row['reserveId']}</td>
                <td>{$row['reservationDate']}</td>
                <td>{$row['pickupDate']}</td>
                <td>{$row['returnDate']}</td>
                <td>{$row['payment']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No results found.";
}
}



if (!empty($customerInfo)) {
    $params = [];
$types = "";
$query = "SELECT 
            v.plateNo, v.model, v.color, v.dailyPrice, v.year, v.status,
            c.customerId, c.name AS customerName, c.email, c.phoneNumber,
            r.reserveId, r.reservationDate, r.pickupDate, r.returnDate, r.payment
          FROM customer c
          LEFT JOIN reservation r ON c.customerId = r.customerId
          LEFT JOIN vehicle v ON r.plateNo = v.plateNo
          WHERE 1=1";

$customerInfoParts = explode(' ', $customerInfo);
$query .= " AND (";
$customerConditions = [];
foreach ($customerInfoParts as $part) {
    $customerConditions[] = "(c.name LIKE ? OR c.customerId LIKE ?)";
    $params[] = "%$part%";
    $params[] = "%$part%";
    $types .= "ss";
}
$query .= implode(" OR ", $customerConditions) . ")";
$stmt = $conn->prepare($query);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
 if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr>
            <th>Plate Number</th>
            <th>Model</th>
            <th>Color</th>
            <th>Daily Price</th>
            <th>Year</th>
            <th>Status</th>
            <th>Customer ID</th>
            <th>Customer Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Reservation ID</th>
            <th>Reservation Date</th>
            <th>Pickup Date</th>
            <th>Return Date</th>
            <th>Payment</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['plateNo']}</td>
                <td>{$row['model']}</td>
                <td>{$row['color']}</td>
                <td>{$row['dailyPrice']}</td>
                <td>{$row['year']}</td>
                <td>{$row['status']}</td>
                <td>{$row['customerId']}</td>
                <td>{$row['customerName']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phoneNumber']}</td>
                <td>{$row['reserveId']}</td>
                <td>{$row['reservationDate']}</td>
                <td>{$row['pickupDate']}</td>
                <td>{$row['returnDate']}</td>
                <td>{$row['payment']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No results found.";
}
    
}

if (!empty($reservationDay)) {
    $params = [];
$types = "";
$query = "SELECT 
            v.plateNo, v.model, v.color, v.dailyPrice, v.year, v.status,
            c.customerId, c.name AS customerName, c.email, c.phoneNumber,
            r.reserveId, r.reservationDate, r.pickupDate, r.returnDate, r.payment
          FROM reservation r
          LEFT JOIN vehicle v ON r.plateNo = v.plateNo
          LEFT JOIN customer c ON r.customerId = c.customerId
          WHERE 1=1";

$customerInfoParts = explode(' ', $reservationDay);
$query .= " AND (";
$reservationConditions = [];

    $reservationConditions[] = "(r.reservationDate LIKE ? )";
    $params[] = "%$reservationDay%";
    $types .= "s";
$query .= implode(" OR ", $reservationConditions) . ")";
$stmt = $conn->prepare($query);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
 if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr>
            <th>Plate Number</th>
            <th>Model</th>
            <th>Color</th>
            <th>Daily Price</th>
            <th>Year</th>
            <th>Status</th>
            <th>Customer ID</th>
            <th>Customer Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Reservation ID</th>
            <th>Reservation Date</th>
            <th>Pickup Date</th>
            <th>Return Date</th>
            <th>Payment</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['plateNo']}</td>
                <td>{$row['model']}</td>
                <td>{$row['color']}</td>
                <td>{$row['dailyPrice']}</td>
                <td>{$row['year']}</td>
                <td>{$row['status']}</td>
                <td>{$row['customerId']}</td>
                <td>{$row['customerName']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phoneNumber']}</td>
                <td>{$row['reserveId']}</td>
                <td>{$row['reservationDate']}</td>
                <td>{$row['pickupDate']}</td>
                <td>{$row['returnDate']}</td>
                <td>{$row['payment']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No results found.";
}
}



// Close the connection
$conn->close();
?>
