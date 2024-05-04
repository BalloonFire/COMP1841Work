<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['admin'] !== 'Y') {
    header('Location: ../login.php');
    exit();
}

include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';

// Perform necessary checks and database queries to delete the module
// You can use $_GET['id'] to get the module ID for deletion

if (isset($_GET['id'])) {
    $moduleId = $_GET['id'];

    // Delete the module from the database
    deleteModule($pdo, $moduleId);
}

// Redirect to the manage_modules page
header('Location: manage_modules.php');
exit();
?>
