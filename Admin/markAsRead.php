<?php
include '../config/connection.php';

header('Content-Type: application/json');

// Check if `username` is provided
if (!isset($_GET['username'])) {
    echo json_encode(['status' => 'error', 'message' => 'Username not provided']);
    exit();
}

$username = $_GET['username'];

try {
    // Log the username for debugging
    error_log("Username provided: " . $username);

    // Update messages where `is_read` is 0
    $query = "UPDATE messages SET is_read = 1 WHERE username = ? AND is_read = 0";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error); // Log prepare error
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement']);
        exit();
    }

    $stmt->bind_param("s", $username);

    if (!$stmt->execute()) {
        error_log("Execute failed: " . $stmt->error); // Log execute error
        echo json_encode(['status' => 'error', 'message' => 'Failed to execute query']);
        exit();
    }

    // Log the number of rows affected
    error_log("Rows affected: " . $stmt->affected_rows);

    if ($stmt->affected_rows > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Messages marked as read.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No unread messages found for the user.']);
    }
} catch (Exception $e) {
    error_log("Exception: " . $e->getMessage()); // Log exception
    echo json_encode(['status' => 'error', 'message' => 'An error occurred.']);
}
?>
