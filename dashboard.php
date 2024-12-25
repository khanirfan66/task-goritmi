<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Retrieve user information from the session
$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="w-full max-w-lg p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-2xl font-semibold text-center text-gray-800">Welcome, <?php echo htmlspecialchars($user_name); ?>!</h2>
            <p class="mt-4 text-center text-gray-600">Here is your profile information:</p>
            <div class="mt-6 space-y-4">
                <div>
                    <p class="font-medium text-gray-700">Name:</p>
                    <p class="text-gray-800"><?php echo htmlspecialchars($user_name); ?></p>
                </div>
                <div>
                    <p class="font-medium text-gray-700">Email:</p>
                    <p class="text-gray-800"><?php echo htmlspecialchars($user_email); ?></p>
                </div>
            </div>
            <div class="mt-6 text-center">
                <a href="logout.php" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>
