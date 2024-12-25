<?php
require 'database/config.php';
require 'vendor/autoload.php'; // PHPMailer autoload file

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars(trim($_POST['email']));

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email address.");
    }

    try {
        // Check if the email exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Generate a secure token
            $token = bin2hex(random_bytes(32));

            // Store token with expiry in password_resets table
            $stmt = $conn->prepare("INSERT INTO password_resets (email, token) VALUES (:email, :token)");
            $stmt->execute([
                'email' => $email,
                'token' => $token,
                // 'expires_at' => date('Y-m-d H:i:s', strtotime('+1 hour')) // Token valid for 1 hour
            ]);

            // Create reset link
            $resetLink = "https://irfan.ddev.site/reset_password.php?token=$token";

            // Configure PHPMailer
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'irfanullah8874@gmail.com';
            $mail->Password = 'vdvhtsxmkbdqvdgx'; // Replace with your App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Email details
            $mail->setFrom('irfanullah8874@gmail.com', 'Irfan Ullah');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $mail->Body = "
                <p>Dear User,</p>
                <p>We received a request to reset your password. Click the link below to reset it:</p>
                <p><a href='$resetLink'>$resetLink</a></p>
                <p>If you did not request a password reset, please ignore this email.</p>
                <p>Thank you,</p>
                <p>Your Team</p>";

            // Send the email
            $mail->send();

            echo "A password reset link has been sent to your email.";
        } else {
            echo "Email not found.";
        }
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }
}
?>
