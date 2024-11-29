<?php
include '../config/connection.php';

header('Content-Type: application/json');

// Fetch the user list with their latest message, time, and unread count
$query = "
    SELECT 
        username,
        MAX(date_sent) AS last_message_time,
        (SELECT body FROM messages 
         WHERE messages.username = m.username 
         ORDER BY date_sent DESC 
         LIMIT 1) AS recent_message,
        (SELECT COUNT(*) FROM messages 
         WHERE messages.username = m.username AND is_read = 0) AS unread_count
    FROM 
        messages m
    GROUP BY 
        username
    ORDER BY 
        last_message_time DESC
";

$result = $conn->query($query);

$users = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = [
            'username' => htmlspecialchars($row['username']),
            'recent_message' => htmlspecialchars($row['recent_message']),
            'last_message_time' => date('h:i A', strtotime($row['last_message_time'])), // Format time
            'unread_count' => (int) $row['unread_count'],
        ];
    }
}

// Return JSON response
echo json_encode($users);
?>
