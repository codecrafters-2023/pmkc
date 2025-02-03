<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Path to PHPMailer autoload

// Only process POST requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);

    // Validate inputs
    if (empty($name) || empty($email) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Please complete the form and try again.";
        exit;
    }

    // Configure PHPMailer
    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration (e.g., Gmail, Elastic Email)
        $mail->isSMTP();
        $mail->Host = 'smtp.elasticemail.com'; // Replace with your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'gurbir99156@gmail.com'; // Your SMTP email
        $mail->Password = 'C6EA121AC89C1F28C30BE579664BE245BB25'; // SMTP password or App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 2525;

        // Recipient and sender
        $mail->setFrom($email, $name); // Sender's email and name
        $mail->addAddress('gurbir99156@gmail.com'); // Recipient's email

        // Email content
        $mail->Subject = $subject;
        $mail->Body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

        // Send email
        $mail->send();
        http_response_code(200);
        echo "Thank You! Your message has been sent.";
    } catch (Exception $e) {
        http_response_code(500);
        echo "Oops! Something went wrong: " . $e->getMessage();
    }
} else {
    // Not a POST request
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>