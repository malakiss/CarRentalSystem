<?php
session_start();
include 'connection.php'; // Include database connection

// Initialize variables
$search_query = '';
$cars = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['search_query'])) {
    $search_query = $_POST['search_query'];

    // Split the search query into individual terms
    $keywords = preg_split('/\s+/', $search_query); // Split by spaces
    $conditions = [];
    $params = [];
    $param_types = '';

    // Build dynamic conditions for each keyword
    foreach ($keywords as $keyword) {
        $conditions[] = "(v.color LIKE ? OR v.model LIKE ? OR v.year LIKE ? OR o.city LIKE ?)";
        $search_term = "%$keyword%";
        $params[] = $search_term;
        $params[] = $search_term;
        $params[] = $search_term;
        $params[] = $search_term;
        $param_types .= 'ssss';
    }

    // Join conditions with AND to match all keywords
    $where_clause = implode(' AND ', $conditions);

    // Final query
    $sql = "SELECT distinct v.plateNo, v.color, v.model, v.year, v.dailyPrice, o.city 
            FROM vehicle v
            JOIN office o ON v.officeId = o.officeId
            WHERE  ($where_clause)";
    $stmt = $conn->prepare($sql);

    // Bind parameters dynamically
    $stmt->bind_param($param_types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();
    $cars = $result->fetch_all(MYSQLI_ASSOC);
} else {
    // Default query to fetch all available cars
   
    $sql =   "SELECT distinct v.plateNo, v.color, v.model, v.year, v.dailyPrice, o.city
            FROM vehicle v
            JOIN office o ON v.officeId = o.officeId
            JOIN vehicle_status vs ON v.plateNo = vs.plateNo
            WHERE vs.statusDate = (
                SELECT MAX(vs2.statusDate)
                FROM vehicle_status vs2
                WHERE vs2.plateNo = vs.plateNo AND vs2.statusDate <= CURRENT_DATE() AND vs2.status = 'available' 
            )";
    $result = $conn->query($sql);
    $cars = $result->fetch_all(MYSQLI_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Search</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h1>Search Cars</h1>
        <h1></h1>
        <!-- Search Form -->
        <form action="customer_search.php" method="POST" class="search-customer-form">
            <div class="form-group">
                <label for="search_query">Search Car</label>
                <input type="text" id="search_query" name="search_query"
                    placeholder="Enter color, model, year, city..."
                    value="<?php echo htmlspecialchars($search_query); ?>">
            </div>
            <button type="submit" class="submit-button">Search</button>
        </form>

        <!-- Available Cars Section -->
        <div class="available-cars">
            <h2>Available Cars</h2>
            <div class="card-deck">
                <?php if (!empty($cars)): ?>
                    <?php foreach ($cars as $car): ?>
                        <div class="card mb-4" style="min-width: 18rem;">
                            <img class="card-img-top" src="carimage2.jpeg" alt="Car Image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($car['model']); ?> (<?php echo htmlspecialchars($car['year']); ?>)</h5>
                                <p class="card-text">
                                    <strong>Color:</strong> <?php echo htmlspecialchars($car['color']); ?><br>
                                    <strong>City:</strong> <?php echo htmlspecialchars($car['city']); ?><br>
                                    <strong>Daily Price:</strong> $<?php echo htmlspecialchars($car['dailyPrice']); ?>
                                </p>
                                <a href="reservation.php?plateNo=<?php echo urlencode($car['plateNo']); ?>" class="btn btn-primary">Rent</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No cars found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>