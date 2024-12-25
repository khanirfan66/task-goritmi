<?php
require 'database/config.php';
session_start();

$error = null; // Initialize the variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = $_POST['password'];

    try {
        // Check admin credentials
        $stmt = $conn->prepare("SELECT * FROM admins WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && password_verify($password, $admin['password'])) {
            // Store admin session
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];

            header("Location: admin_dashboard.php");
            exit;
        } else {
            $error = "Invalid username or password.";
        }
    } catch (PDOException $e) {
        $error = "An error occurred: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Error</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-xl font-semibold text-center text-red-500">Login Failed</h2>
            <p class="mt-4 text-center text-gray-700"><?php echo $error ?? 'An unknown error occurred.'; ?></p>
            <div class="text-center mt-6">
                <a href="admin_login.php" class="text-sm text-blue-500 hover:underline">Go Back to Login</a>
            </div>
        </div>
    </div>
</body>
</html>
