<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['admin'] !== 'Y') {
    header('Location: ../login.php');
    exit();
}

include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';

// Retrieve the user ID from the URL parameter
$userIdToDelete = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        // Delete the user from the database
        deleteUser($pdo, $userIdToDelete);

        // Redirect back to the user table page after deletion
        header('Location: user_table.php');
        exit();
    } catch (PDOException $e) {
        $error = 'Error deleting user: ' . $e->getMessage();
    }
}

$title = 'Delete User';
ob_start();
include '../templates/delete_user.html.php';
$output = ob_get_clean();
include '../templates/adminlayout.html.php';
?>
