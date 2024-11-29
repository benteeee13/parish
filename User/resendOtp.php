<?php
session_start();

// Generate a random 6-digit OTP
$otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

// Store OTP in session
$_SESSION['otp'] = $otp;

// Send OTP via email
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'sanjuan.parish1@gmail.com'; // Replace with your email
    $mail->Password = 'vhsw gzrv uhpa sxbv'; // Replace with your email password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('sanjuan.parish1@gmail.com', 'Parish of San Juan');
    $mail->addAddress($_SESSION['emailorNum']); // Send to user's email

    $mail->Subject = 'Your OTP for Password Reset';
    $mail->Body = "Your OTP is: $otp";

    $mail->send();
    echo 'OTP has been sent!';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
