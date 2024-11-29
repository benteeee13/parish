<?php 
    // Database connection
    include '../config/connection.php';

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $contact_number = $_POST['contact_number'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Validate password and confirm password
        if ($password !== $confirm_password) {
            echo "<script>alert('Passwords do not match!');</script>";
            exit();
        }

        // Check if the email or username already exists
        $stmt = $conn->prepare("SELECT id FROM user WHERE email = ? OR username = ?");
        $stmt->bind_param("ss", $email, $username);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            // Email or username already exists
            echo "<script>alert('Email or Username already exists!');</script>";
        
            exit();
        }
        
        $stmt->close();

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and bind for insert
        $stmt = $conn->prepare("INSERT INTO user (email, username, contact_num, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $email, $username, $contact_number, $hashedPassword);

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful!');</script>"; 
            // Optionally redirect to login page
            header("Location: userLogin.php");
            exit();
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    }

    $conn->close(); 
?>
