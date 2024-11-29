<?php
include '../config/connection.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start session if it's not already active
}

if (isset($_SESSION['username'])) {  // Using 'username' in the session
    // Get the username from the session
    $username = $_SESSION['username'];
    
    // Query to check if the user is restricted based on the username
    $sql = "SELECT is_restricted FROM user WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);  // Use 's' for string binding
    $stmt->execute();
    $stmt->bind_result($is_restricted);
    $stmt->fetch();
    $stmt->close();

    // If the user is restricted, log them out
    if ($is_restricted == 1) {
        header("Location: userLogout.php");
        exit();
    }
}
?>
