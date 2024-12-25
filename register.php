<?php
require 'database/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize input
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $password = $_POST['password'];

    // Validate required fields
    if (empty($name) || empty($email) || empty($phone) || empty($gender) || empty($password)) {
        die("All fields are required.");
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    try {
        // Insert user into the database
        $stmt = $conn->prepare("INSERT INTO users (name, email, phone, gender, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $phone, $gender, $hashedPassword]);

        // Send a welcome email (optional, will implement later)
        echo "Registration successful!";
        mail($email,"You Have SuccessFully Register Your Email Adress","You Have SuccessFully Register Your Email Adress");
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo "Email is already registered.";
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>



