<?php

session_start();

// Verify if the admin session exists
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}


require 'database/config.php';

// Fetch all users
$stmt = $conn->query("SELECT id, name, email, phone, gender FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col items-center p-4">
        <div class="w-full max-w-6xl p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-2xl font-semibold text-gray-800">Admin Dashboard</h2>
            <p class="mt-2 text-gray-600">Manage users below:</p>
            <table class="w-full mt-6 border-collapse">
                <thead>
                    <tr>
                        <th class="border-b p-2 text-left">ID</th>
                        <th class="border-b p-2 text-left">Name</th>
                        <th class="border-b p-2 text-left">Email</th>
                        <th class="border-b p-2 text-left">Phone</th>
                        <th class="border-b p-2 text-left">Gender</th>
                        <th class="border-b p-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td class="border-b p-2"><?php echo htmlspecialchars($user['id']); ?></td>
                            <td class="border-b p-2"><?php echo htmlspecialchars($user['name']); ?></td>
                            <td class="border-b p-2"><?php echo htmlspecialchars($user['email']); ?></td>
                            <td class="border-b p-2"><?php echo htmlspecialchars($user['phone']); ?></td>
                            <td class="border-b p-2"><?php echo htmlspecialchars($user['gender']); ?></td>
                            <td class="border-b p-2">
                                <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="text-blue-500 hover:underline">Edit</a> |
                                <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="text-red-500 hover:underline" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="mt-6 text-center">
                <a href="admin_logout.php" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>
