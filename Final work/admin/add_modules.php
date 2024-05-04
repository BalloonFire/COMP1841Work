<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['admin'] !== 'Y') {
    header('Location: ../login.php');
    exit();
}

include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['module_name'])) {
    $moduleName = $_POST['module_name'];

    // Add the module to the database
    addModule($pdo, $moduleName);

    // Redirect to the manage_modules page
    header('Location: ../admin/manage_modules.php');
    exit();
}

$title = 'Add Module';
$output = ob_get_clean();
include '../templates/adminlayout.html.php';
?>