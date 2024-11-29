<?php
include 'userSessionStart.php';
include '../vendor/autoload.php'; // Load PHPMailer using Composer
include '../config/connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailOrNum = $_POST['emailOrNum'];

    // Check if email or contact number exists in the database
    $stmt = $conn->prepare("SELECT id, email FROM user WHERE email = ? OR contact_num = ?");
    $stmt->bind_param("ss", $emailOrNum, $emailOrNum);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $userId = $user['id'];
        $email = $user['email'];

        // Generate a 6-digit OTP
        $otp = rand(100000, 999999);

        // Set expiration time for OTP (10 minutes from now)
        $expiresAt = date("Y-m-d H:i:s", strtotime("+10 minutes"));

        // Insert OTP into the database
        $stmt = $conn->prepare("INSERT INTO otp_verification (user_id, otp_code, expires_at) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $userId, $otp, $expiresAt);
        $stmt->execute();

        // Send OTP via email
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'sanjuan.parish1@gmail.com'; // Replace with your email address
            $mail->Password = 'vhsw gzrv uhpa sxbv'; // Replace with your email password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Email settings
            $mail->setFrom('sanjuan.parish1@gmail.com', 'Parish of San Juan');
            $mail->addAddress($email);
            $mail->Subject = 'Your OTP for Password Recovery';
            $mail->Body = "Your OTP is: $otp. It will expire in 10 minutes.";

            $mail->send();

            // Set session variables for OTP and redirect
            $_SESSION['emailorNum'] = $emailOrNum; // Store email/contact
            $_SESSION['otp'] = $otp; // Store OTP for verification
            $_SESSION['success'] = 'OTP has been sent to your email.';
            header("Location: userVerify.php"); // Redirect to the verification page
            exit();
        } catch (Exception $e) {
            $_SESSION['error'] = "Failed to send OTP: {$mail->ErrorInfo}";
            header("Location: userForgotPass.php"); // Redirect back to the same page with an error
            exit();
        }
    } else {
        $_SESSION['error'] = 'Email or Contact Number Not Found!';
        header("Location: userForgotPass.php");
        exit();
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

        .forgotPText {
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

        #btnSend {
            background-color: #28a745;
            color: #fff;
        }

        #btnSend:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <?php include 'userHeader.php'; ?>
    <div id="whiteBox">
        <form id="redBox" method="POST" action="">
            <h1 id="forgotPass" class="forgotPText">Forgot Password</h1>
            <p id="textOne" class="forgotPText">Please Enter Your Email Address</p>
            <p id="textTwo" class="forgotPText">To Receive a Verification Code</p>
            <div class="input-group">
                <input type="text" name="emailOrNum" id="txtEmail" class="text-input" placeholder="Enter your email" required>
            </div>
            <div class="btn-group">
                <button type="submit" id="btnSend" class="btn">Send</button>
            </div>
        </form>
        <?php
        if (isset($_SESSION['error'])) {
            echo "<script>alert('".$_SESSION['error']."');</script>";
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
            echo "<script>alert('".$_SESSION['success']."');</script>";
            unset($_SESSION['success']);
        }
        ?>
    </div>
</body>
</html>
