<?php
include 'userSessionStart.php';
include '../config/connection.php'; // Include database connection
include '../vendor/autoload.php'; // Include PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if user email or contact info exists in session
if (!isset($_SESSION['emailorNum'])) {
    header("Location: userForgotPass.php");
    exit();
}

$userInfo = $_SESSION['emailorNum'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form was submitted for OTP verification or resend
    if (isset($_POST['verify_otp'])) {
        // Combine all the digits entered by the user
        $enteredCode = implode('', [
            $_POST['digit1'],
            $_POST['digit2'],
            $_POST['digit3'],
            $_POST['digit4'],
            $_POST['digit5'],
            $_POST['digit6']
        ]);

        // Fetch OTP and expiration details from the database
        $stmt = $conn->prepare("SELECT otp_code, expires_at, is_used FROM otp_verification WHERE otp_code = ? AND user_id = (SELECT id FROM user WHERE email = ? OR contact_num = ?)");
        $stmt->bind_param("sss", $enteredCode, $userInfo, $userInfo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $otpData = $result->fetch_assoc();
            $expiresAt = $otpData['expires_at'];
            $isUsed = $otpData['is_used'];

            // Check if OTP is expired or already used
            if ($isUsed == 1) {
                echo "<script>
                    alert('This OTP has already been used. Please request a new one.');
                </script>";
            } elseif (strtotime($expiresAt) >= time()) {
                // OTP is valid and not expired
                // Mark the OTP as used
                $stmt = $conn->prepare("UPDATE otp_verification SET is_used = 1 WHERE otp_code = ?");
                $stmt->bind_param("s", $enteredCode);
                $stmt->execute();

                echo "<script>
                    alert('Verification successful!');
                    window.location.href = 'userResetPassword.php'; // Redirect to set a new password
                </script>";
                exit();
            } else {
                // OTP is expired
                echo "<script>
                    alert('OTP has expired. Please request a new one.');
                </script>";
            }
        } else {
            // OTP is invalid
            echo "<script>
                alert('Incorrect OTP. Please try again.');
            </script>";
        }
    } elseif (isset($_POST['resend_otp'])) {
        // Resend OTP logic
        $stmt = $conn->prepare("SELECT id, email FROM user WHERE email = ? OR contact_num = ?");
        $stmt->bind_param("ss", $userInfo, $userInfo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $userId = $user['id'];
            $email = $user['email'];

            // Generate a new OTP
            $otp = rand(100000, 999999);
            $expiresAt = date("Y-m-d H:i:s", strtotime("+10 minutes"));

            // Insert the new OTP into the database
            $stmt = $conn->prepare("INSERT INTO otp_verification (user_id, otp_code, expires_at, is_used) VALUES (?, ?, ?, 0) ON DUPLICATE KEY UPDATE otp_code = VALUES(otp_code), expires_at = VALUES(expires_at), is_used = 0");
            $stmt->bind_param("iss", $userId, $otp, $expiresAt);
            $stmt->execute();

            // Send the new OTP via email
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // SMTP server
                $mail->SMTPAuth = true;
                $mail->Username = 'sanjuan.parish1@gmail.com'; // Your email
                $mail->Password = 'vhsw gzrv uhpa sxbv'; // Your app password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Email settings
                $mail->setFrom('sanjuan.parish1@gmail.com', 'Parish of San Juan');
                $mail->addAddress($email);
                $mail->Subject = 'Your OTP for Password Reset';
                $mail->Body = "Your OTP is: $otp";

                $mail->send();
                echo "<script>alert('A new OTP has been sent to your email.');</script>";
            } catch (Exception $e) {
                echo "<script>alert('Failed to resend OTP. Please try again later.');</script>";
            }
        }
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

        .otp-input-group {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 20px 0;
        }

        .otp-input {
            width: 50px;
            height: 50px;
            border: 2px solid #fff;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.9);
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #333;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .otp-input:focus {
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

        #btnVerify {
            background-color: #28a745;
            color: #fff;
        }

        #btnVerify:hover {
            background-color: #218838;
        }

        #btnResend {
            background-color: transparent;
            color: #fff;
            text-decoration: underline;
        }

        #btnResend:hover {
            color: #ffc107;
        }
    </style>
</head>
<body>
    <?php include 'userHeader.php'; ?>
    <div id="whiteBox">
        <form id="redBox" method="POST" action="">
            <h1 id="verifyHeader" class="pVerify">Verify OTP</h1>
            <p id="textOne" class="pVerify">Please Enter the 6 Digit OTP Sent to</p>
            <p id="displayInfo" class="pVerify"><?php echo htmlspecialchars($userInfo); ?></p>
            <div class="otp-input-group">
                <input type="text" name="digit1" maxlength="1" class="otp-input">
                <input type="text" name="digit2" maxlength="1" class="otp-input">
                <input type="text" name="digit3" maxlength="1" class="otp-input">
                <input type="text" name="digit4" maxlength="1" class="otp-input">
                <input type="text" name="digit5" maxlength="1" class="otp-input">
                <input type="text" name="digit6" maxlength="1" class="otp-input">
            </div>
            <div class="btn-group">
                <!-- Verify OTP Form -->
                <button type="submit" name="verify_otp" id="btnVerify" class="btn">Verify</button>
                <!-- Resend Code Form -->
                <form method="POST" action="" style="margin-bottom: 10px;">
                    <button type="submit" name="resend_otp" id="btnResend" class="btn">Resend Code</button>
                </form>

            </div>
        </form>
    </div>
</body>
</html>
