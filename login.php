<?php
require 'database/config.php'; // Include database connection

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identifier = htmlspecialchars(trim($_POST['identifier']));
    $password = $_POST['password'];

    try {
        // Fetch user details from database
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :identifier OR name = :identifier");
        $stmt->execute(['identifier' => $identifier]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Store user information in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];

            // Redirect to dashboard
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid email/name or password.";
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
    <title>Login Error</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-xl font-semibold text-center text-red-500">Login Failed</h2>
            <p class="mt-4 text-center text-gray-700"><?php echo $error ?? 'An unknown error occurred.'; ?></p>
            <div class="text-center mt-6">
                <a href="login.php" class="text-sm text-blue-500 hover:underline">Go Back to Login</a>
            </div>
        </div>
    </div>
</body>
</html>
