<?php
include '../config/connection.php';
session_start();

$username = $_SESSION['username'];

// Query to fetch messages between the user and admin
$sql = "SELECT sender, body FROM messages WHERE username = ? ORDER BY date_sent ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

// Return messages as JSON
echo json_encode($messages);
?>
