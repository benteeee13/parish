<?php
session_start();
include '../config/connection.php'; // Include your database connection

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->close();
?>
