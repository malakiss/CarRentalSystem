<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'connection.php';  

    $email = $_POST['email'];
    $password = $_POST['password'];

    $user_check_query = "SELECT * FROM customer WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $user_check_query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['customer_id'] = $row['customer_id'];
            $_SESSION['name'] = $row['name'];
            header('Location: customer_search.html');
            exit;
        } else {
            echo "Email or password are incorrect!";
        }
    } else {
        echo "Error in query: " . mysqli_error($conn);
    }
}
?>
