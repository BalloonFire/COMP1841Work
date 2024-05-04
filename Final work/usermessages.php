<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['MContent'])) {
    try {
        include 'includes/DatabaseConnection.php';
        include 'includes/DatabaseFunctions.php';

        // Insert message into the usermessages table
        insertUserMessage(
            $pdo,
            $_POST['MContent'],
            $_SESSION['id']
        );

        // Redirect to a success page or perform other actions as needed
        header('Location: index.php');
        exit();
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }
} else {
    include 'includes/DatabaseConnection.php';
    include 'includes/DatabaseFunctions.php';
    $title = 'Send Messages to Admin';
    ob_start();
    include 'templates/sendmessage.html.php';
    $output = ob_get_clean();
}
include 'templates/layout.html.php';
?>