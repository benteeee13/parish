<?php
include 'adminSessionStart.php';
include '../config/connection.php';

if (!isset($_SESSION['adminUsername'])) {
    header("Location: adminLogin.php");
    exit();
}

// Check if the message ID is provided
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $message_id = $_GET['id'];

    // Fetch the message details
    $sql = "SELECT username, subject, body, date_sent FROM messages WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $message_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($message = $result->fetch_assoc()) {
        $sender = htmlspecialchars($message['username']);
        $subject = htmlspecialchars($message['subject']);
        $body = nl2br(htmlspecialchars($message['body']));
        $date_sent = $message['date_sent'];
    } else {
        echo "Message not found.";
        exit();
    }
} else {
    echo "Invalid message ID.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Message</title>
    <link rel="stylesheet" href="adminHomepage.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include 'adminHeader.php'; ?>
    <div class='container mt-5'>
        <h2>Message Details</h2>
        <div class="card">
            <div class="card-header">
                <strong>Subject:</strong> <?php echo $subject; ?>
            </div>
            <div class="card-body">
                <p><strong>Sender:</strong> <?php echo $sender; ?></p>
                <p><strong>Date Sent:</strong> <?php echo $date_sent; ?></p>
                <p><strong>Message:</strong></p>
                <p><?php echo $body; ?></p>
            </div>
        </div>
        <a href="adminMessage.php" class="btn btn-primary mt-3">Back to Messages</a>
    </div>
</body>
</html>
