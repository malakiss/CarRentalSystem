<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'connection.php';  

    $email = $_POST['email'];
    $password = $_POST['password'];

    $user_check_query = "SELECT * FROM customer WHERE email = '$email'";
    $result = mysqli_query($conn, $user_check_query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);


            if ($password== $row['password']) {
                $_SESSION['customer_id'] = $row['customerId'];
                $_SESSION['name'] = $row['name'];
                header('Location: customer_search.php');
                exit;
            } else {
                // Incorrect password
                echo '<script>
                        alert("Incorrect password. Please try again!");
                        window.location.href = "customer_search.php";
                      </script>';
            }
        } else {
            // Email not found
            echo '<script>
                    alert("No account found with this email. Please sign up!");
                    window.location.href = "signup.html";
                  </script>';
        }
    } else {
        echo "Error in query: " . mysqli_error($conn);
    }
}
?>
