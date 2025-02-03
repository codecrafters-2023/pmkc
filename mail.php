<?php
// Include PHPMailer files
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // SMTP Configuration (e.g., Gmail, Elastic Email)
    $mail->isSMTP();
    $mail->Host = 'smtp.elasticemail.com'; // Replace with your SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'gurbir99156@gmail.com'; // Your SMTP email
    $mail->Password = 'C6EA121AC89C1F28C30BE579664BE245BB25'; // SMTP password or App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use TLS encryption
    $mail->Port = 2525; // Port for TLS

    // Email Content
    $mail->setFrom('gurbir99156@gmail.com', 'Gurbir Singh'); // Sender's email and name
    $mail->addAddress('codecrafters@gurmaanitservices.com'); // Recipient's email
    $mail->Subject = 'Test Email from PHPMailer';
    $mail->Body = 'This is a test email sent using PHPMailer without Composer.';

    // Send email
    $mail->send();
    echo 'Email sent successfully!';
} catch (Exception $e) {
    echo "Email could not be sent. Error: {$mail->ErrorInfo}";
}
?>