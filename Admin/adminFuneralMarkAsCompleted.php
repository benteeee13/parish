<?php
include '../config/connection.php'; // Make sure to include the database connection

// Check if an ID is provided via POST
if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    
    // Update the status of the record to 'completed'
    $updateQuery = "UPDATE funeral_applications SET status = 'completed' WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("i", $id);
    $success = $stmt->execute();

    if ($success) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    
    $stmt->close();
} else {
    echo json_encode(['success' => false]);
}
$conn->close();
?>
