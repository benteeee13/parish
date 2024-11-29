<?php
include '../config/connection.php';

if (!isset($_GET['username'])) {
    echo json_encode(['error' => 'Username not provided']);
    exit();
}

$username = $_GET['username'];

// Fetch messages for the selected user
$query = "SELECT sender, body, date_sent, username FROM messages WHERE username = ? ORDER BY date_sent ASC";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

// Return messages as JSON
echo json_encode(['messages' => $messages]);
?>
