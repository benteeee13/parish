<?php
include '../config/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sender = $_POST['sender'];
    $body = htmlspecialchars($_POST['replyMessage']);
    $username = $_POST['username']; // Selected user

    $query = "INSERT INTO messages (username, body, sender) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $username, $body, $sender);

    if ($stmt->execute()) {
        echo "Message sent";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
