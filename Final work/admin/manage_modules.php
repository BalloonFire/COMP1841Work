<?php
session_start();
// Redirect to login page if not logged in or not an admin
if (!isset($_SESSION['id']) || $_SESSION['admin'] !== 'Y') {
    header('Location: ../login.php');
    exit();
}
include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';

// Get all modules from the database
$modules = allModules($pdo);

ob_start();
include '../templates/manage_modules.html.php';
$title = 'Manage Modules';
$output = ob_get_clean();
include '../templates/adminlayout.html.php';
?>