<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'connection.php'; // Include the database connection

    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
    $phone = $_POST['phone'];

    // Validate the pass
    if ($password !== $confirmPassword) {
        echo '<script>
                alert("Passwords do not match!");
                window.location.href = "signup.html";
              </script>';
        exit;
    }

    // Check if the email is already registered
    $emailCheckQuery = "SELECT * FROM customer WHERE email = '$email'";
    $emailCheckResult = mysqli_query($conn, $emailCheckQuery);

    if (mysqli_num_rows($emailCheckResult) > 0) {
        echo '<script>
                alert("Email is already registered. Please use another email.");
                window.location.href = "signup.html";
              </script>';
        exit;
    }

    // Insert the new user into the database
   // $hashedPassword = password_hash($password,  PASSWORD_BCRYPT); // Hash the password
    $insertQuery = "INSERT INTO customer (name, email, password, phoneNumber) 
                    VALUES ('$name', '$email', '$password', '$phone')";

    if (mysqli_query($conn, $insertQuery)) {
      $user_check_query = "SELECT * FROM customer WHERE email = '$email'";
      $result = mysqli_query($conn, $user_check_query);
      $row = mysqli_fetch_assoc($result);
      $_SESSION['customer_id'] = $row['customerId'];
      $_SESSION['name'] = $row['name'];
      header('Location: customer_search.php');
      exit;
    } else {
        echo '<script>
                alert("Error: ' . mysqli_error($conn) . '");
                window.location.href = "signup.html";
              </script>';
    }
}
?>
