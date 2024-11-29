<?php
include 'userSessionStart.php'; // Start the session
include '../config/connection.php'; // Include your database connection

if (!isset($_SESSION['username'])) {
    header("Location: userLogin.php"); // Redirect to login if not logged in
    exit();
}

// Initialize variables
$username = $_SESSION['username']; // Get the logged-in user's username
$error = '';
$success = '';

// Function to update the user's password
function updatePassword($conn, $username, $oldPass, $newPass) {
    // Query to fetch the current password
    $query = "SELECT password FROM user WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $currentPassword = $row['password'];

        // Verify the old password
        if (password_verify($oldPass, $currentPassword)) {
            // Check if the new password is the same as the old password
            if (password_verify($newPass, $currentPassword)) {
                return "New password must be different from the old password.";
            }

            // Hash the new password
            $hashedPassword = password_hash($newPass, PASSWORD_DEFAULT);

            // Update the password in the database
            $updateQuery = "UPDATE user SET password = ? WHERE username = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param('ss', $hashedPassword, $username);

            if ($updateStmt->execute()) {
                return true; // Password updated successfully
            } else {
                return "Failed to update password. Please try again.";
            }
        } else {
            return "Incorrect old password.";
        }
    } else {
        return "User not found.";
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $oldPass = $_POST['oldPass'];
    $newPass = $_POST['newPass'];
    $confirmNewPass = $_POST['confirmNewPass'];

    if ($newPass !== $confirmNewPass) {
        $error = "New password and confirmation password do not match.";
    } else {
        $result = updatePassword($conn, $username, $oldPass, $newPass);
        if ($result === true) {
            $success = "Password updated successfully.";
        } else {
            $error = $result;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Parish of San Juan</title>
    <link rel="stylesheet" href="userNewPassword.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script>
        function btnback(event) {
            event.preventDefault();
            window.location.href = "userAccountSettings.php";
        }
    </script>
</head>
<body>
    <?php include 'userHeader.php'; ?>
    <div id="whiteBox">
        <form id="redBox" method="POST" action="">
            <h1 id="createNewPassword" class="changePassText">Create New Password</h1>
            <br>
            <p id="textOne" class="changePassText">Your New Password Must Be Different</p>
            <br>
            <p id="textTwo" class="changePassText">From Previously Used Password</p>
            <br>
            <input type="password" name="oldPass" id="txtOldPass" placeholder="Old Password" class="newPassText" required>
            <br>
            <input type="password" name="newPass" id="txtNewPass" placeholder="New Password" class="newPassText" required>
            <br>
            <input type="password" name="confirmNewPass" id="txtConfirmNewPass" placeholder="Confirm Password" class="newPassText" required>
            <br>
            <input type="submit" value="Save" id="btnSave">
            <br>
            <input type="button" value="Back" id="btnSave" onclick="btnback(event)">
            <br>
        </form>
        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert alert-success" role="alert">
                <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
