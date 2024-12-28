<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['role'])) {
        $role = $_POST['role'];
        
        if ($role == 'Admin') {
            header('Location: admin.html');
            exit;
        } elseif ($role == 'Customer') {
            header('Location: login.html');
            exit;
        }
    }
}
?>
