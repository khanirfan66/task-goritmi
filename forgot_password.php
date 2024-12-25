<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-2xl font-semibold text-center text-gray-800">Forgot Password</h2>
            <p class="mt-2 text-center text-gray-600">Enter your registered email to reset your password.</p>
            <form action="send_reset_link.php" method="POST" class="mt-6 space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <button type="submit" class="w-full py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Send Reset Link
                </button>
            </form>
        </div>
    </div>
</body>
</html>
