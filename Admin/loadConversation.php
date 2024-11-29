<?php
include '../config/connection.php';

if (!isset($_GET['username'])) {
    echo json_encode(['error' => 'Username is required']);
    exit();
}

$username = $_GET['username'];

// Mark messages as read
$update_query = "UPDATE messages 
                 SET is_read = 1 
                 WHERE username = ? AND sender = 'user'";
$stmt = $conn->prepare($update_query);
$stmt->bind_param('s', $username);
$stmt->execute();

// Fetch the conversation
$conversation_query = "SELECT body, sender, date_sent 
                       FROM messages 
                       WHERE username = ? 
                       ORDER BY date_sent ASC";
$stmt = $conn->prepare($conversation_query);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

echo json_encode(['messages' => $messages]);
?>
