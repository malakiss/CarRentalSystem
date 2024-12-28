<?php
$servername = "127.0.0.1"; 
$username = "root";
$password = "";
$dbname = "carrentalsystem";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$request = json_decode(file_get_contents('php://input'), true) ?: $_GET;

$action = $request['action'] ?? null;

try {
    switch ($action) {
        case 'report1':
            $startDate = $conn->real_escape_string($request['startDate']);
            $endDate = $conn->real_escape_string($request['endDate']);
            $query = "SELECT 
                        v.color,
                        v.dailyPrice,
                        v.year,
                        v.model,
                        vs.status,
                        c.name,
                        c.phoneNumber 
                    FROM vehicle AS v
                    JOIN reservation AS r ON v.plateNo = r.plateNo
                    JOIN vehicle_status As vs ON vs.plateNo=v.plateNo
                    JOIN customer AS c ON r.customerId = c.customerId
                    WHERE r.reservationDate BETWEEN '$startDate' AND '$endDate'";
            break;

        case 'report2':
            $carStartDate = $conn->real_escape_string($request['carStartDate']);
            $carEndDate = $conn->real_escape_string($request['carEndDate']);
            $query = "SELECT  
                        v.color,
                        v.dailyPrice,
                        v.year,
                        v.model,
                        vs.status,
                        r.reservationDate
                    FROM vehicle AS v
                    JOIN reservation AS r ON v.plateNo = r.plateNo
                    JOIN vehicle_status As vs ON vs.plateNo=v.plateNo
                    WHERE r.reservationDate BETWEEN '$carStartDate' AND '$carEndDate'";
            break;

        case 'report3':
            $statusDay = $conn->real_escape_string($request['statusDay']);
            $query = 
                    "SELECT 
                            vs.plateNo, 
                            v.model, 
                            vs.status, 
                            vs.statusDate
                    FROM vehicle_status vs
                    JOIN vehicle v ON vs.plateNo = v.plateNo
                    WHERE vs.statusDate = (
                        SELECT MAX(vs2.statusDate)
                        FROM vehicle_status vs2
                        WHERE vs2.plateNo = vs.plateNo AND vs2.statusDate <= '$statusDay')
                    ORDER BY vs.plateNo";
                            break;

        case 'report4':
            $customerId = $conn->real_escape_string($request['customerId']);
            if (isset($request['customerId']) && is_numeric($request['customerId'])) {
                $customerId = intval($request['customerId']);
            }
            $query = "SELECT 
                        r.reserveId,
                        r.reservationDate,
                        v.plateNo,
                        v.color,
                        v.model
                      FROM reservation AS r
                      JOIN customer AS c ON r.customerId = c.customerId
                      JOIN vehicle AS v ON r.plateNo = v.plateNo
                      WHERE c.customerId = $customerId";
            break;

        case 'report5':
            $paymentStartDate = $conn->real_escape_string($request['paymentStartDate']);
            $paymentEndDate = $conn->real_escape_string($request['paymentEndDate']);
            $query = "SELECT 
                        DATE(r.pickupDate) AS paymentDate,
                        SUM(r.payment) AS totalPayments
                      FROM reservation AS r  
                      WHERE r.pickupDate BETWEEN '$paymentStartDate' AND '$paymentEndDate'
                      GROUP BY DATE(r.pickupDate)";
            break;

        default:
            echo json_encode(['error' => 'Invalid action']);
            exit;
    }

    // Debugging: Print the query
    error_log("Executing query: $query");

    $result = $conn->query($query);

    if (!$result) {
        echo json_encode(['error' => $conn->error]);
        exit;
    }

    $data = $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];
    echo json_encode($data);

} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>