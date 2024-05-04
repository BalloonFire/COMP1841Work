<?php
session_start();

// Redirect to login page if not logged in or not an admin
if (!isset($_SESSION['id']) || $_SESSION['admin'] !== 'Y') {
    header('Location: ../login.php');
    exit();
}

include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';

// Retrieve user details
$userId = $_SESSION['id'];
$userDetails = getUserDetails($pdo, $userId);

// Fetch all users
$users = getUsersInfo($pdo);
$allUsers = allUsers($pdo);

// Process form submissions for revoking or assigning admin roles
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['revoke_admin'])) {
        $userIdToRevoke = $_POST['revoke_admin_id'];
        try {
            // Revoke admin role from the user
            revokeAdminRole($pdo, $userIdToRevoke);
            
            // Redirect back to the user table page after revoking admin role
            header('Location: user_table.php');
            exit();
        } catch (PDOException $e) {
            $error = 'Error revoking admin role: ' . $e->getMessage();
        }
    }

    if (isset($_POST['assign_admin'])) {
        $userIdToAssign = $_POST['assign_admin_id'];
        try {
            // Assign admin role to the user
            assignAdminRole($pdo, $userIdToAssign);
            
            // Redirect back to the user table page after assigning admin role
            header('Location: user_table.php');
            exit();
        } catch (PDOException $e) {
            $error = 'Error assigning admin role: ' . $e->getMessage();
        }
    }
}

$title = 'User Table';
ob_start();
include '../templates/user_table.html.php';
$output = ob_get_clean();
include '../templates/adminlayout.html.php';
?>
