<?php
include 'userSessionStart.php';
include '../config/connection.php'; // Include your database connection

// Check if the user has successfully verified their identity
if (!isset($_SESSION['emailorNum'])) {
    header("Location: userForgotPass.php");
    exit();
}

$userInfo = $_SESSION['emailorNum'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = $_POST['newPass'];
    $confirmPassword = $_POST['confirmNewPass'];

    // Check if passwords match
    if ($newPassword === $confirmPassword) {
        // Hash the new password for security
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the user's password in the database
        $stmt = $conn->prepare("UPDATE user SET password = ? WHERE email = ? OR contact_num = ?");
        $stmt->bind_param("sss", $hashedPassword, $userInfo, $userInfo);

        if ($stmt->execute()) {
            // Password updated successfully
            echo "<script>
                alert('Password updated successfully! Please log in with your new password.');
                window.location.href = 'userLogin.php'; // Redirect to login page
            </script>";
        } else {
            // Error updating password
            echo "<script>
                alert('An error occurred while updating your password. Please try again.');
                window.location.href = 'userNewPassword.php'; // Redirect back to the password reset page
            </script>";
        }
    } else {
        // Passwords do not match
        echo "<script>
            alert('Passwords do not match. Please try again.');
            window.location.href = 'userNewPassword.php'; // Redirect back to the password reset page
        </script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Parish of San Juan</title>
    <link rel="stylesheet" href="passRecovery.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        #whiteBox {
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(255, 255, 255, 0.8);
        }

        #redBox {
            background: linear-gradient(to bottom, rgba(255, 0, 0, 0.8), rgba(255, 0, 0, 0.5));
            padding: 30px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            text-align: center;
            color: #fff;
            width: 100%;
            max-width: 400px;
        }

        .pVerify {
            margin: 5px 0;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin: 20px 0;
        }

        .text-input {
            width: 100%;
            height: 50px;
            border: 2px solid #fff;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.9);
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            color: #333;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .text-input:focus {
            border-color: #007bff;
        }

        .btn-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
            max-width: 200px;
        }

        #btnSave {
            background-color: #28a745;
            color: #fff;
        }

        #btnSave:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <?php include 'userHeader.php'; ?>
    <div id="whiteBox">
        <form id="redBox" method="POST" action="">
            <h1 id="createNewPassword" class="pVerify">Create New Password</h1>
            <p id="textOne" class="pVerify">Your New Password Must Be Different</p>
            <p id="textTwo" class="pVerify">From Previously Used Password</p>
            <div class="input-group">
                <input type="password" name="newPass" id="txtNewPass" placeholder="New Password" class="text-input" required>
                <input type="password" name="confirmNewPass" id="txtConfirmNewPass" placeholder="Confirm Password" class="text-input" required>
            </div>
            <div class="btn-group">
                <button type="submit" id="btnSave" class="btn">Save</button>
            </div>
        </form>
    </div>
</body>
</html>
