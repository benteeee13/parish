<?php
include '../config/connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $body = htmlspecialchars($_POST['message']);
    $sender = 'user'; // Sender is the user

    $sql = "INSERT INTO messages (username, body, sender) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $body, $sender);

    if ($stmt->execute()) {
        echo "Message sent";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
