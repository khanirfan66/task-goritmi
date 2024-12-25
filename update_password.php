<?php
require 'database/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($password === $confirmPassword) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        try {
            // Update the user's password
            $stmt = $conn->prepare("UPDATE users SET password = :password WHERE email = :email");
            $stmt->execute(['password' => $hashedPassword, 'email' => $email]);

            // Delete the reset token
            $stmt = $conn->prepare("DELETE FROM password_resets WHERE email = :email");
            $stmt->execute(['email' => $email]);

            echo "Password updated successfully!";
            header("Location: login.php");
            exit;
        } catch (PDOException $e) {
            echo "An error occurred: " . $e->getMessage();
        }
    } else {
        echo "Passwords do not match.";
    }
}
?>
