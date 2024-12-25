<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

require 'database/config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
    $stmt->execute(['id' => $id]);
    header("Location: admin_dashboard.php");
    exit;
} else {
    die("Invalid request.");
}
?>
