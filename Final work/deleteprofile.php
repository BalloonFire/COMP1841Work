<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Delete the user's account
    $userId = $_SESSION['id'];

    try {
        deleteUser($pdo, $userId);

        // Log out the user after deleting the account
        session_unset();
        session_destroy();

        header('Location: login.php');
        exit();
    } catch (PDOException $e) {
        $error = 'Error deleting account: ' . $e->getMessage();
    }
}

ob_start();
include 'templates/deleteprofile.html.php';
$output = ob_get_clean();
$title = 'Delete Account';
include 'templates/layout.html.php';
?>