<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

// Check if 'id' key exists in $_GET
if (isset($_GET['id'])) {
    $QuestionID = $_GET['id'];

    // Process answer submission
    if (isset($_POST['AContent'])) {
        try {
            include 'includes/DatabaseConnection.php';
            include 'includes/DatabaseFunctions.php';

            $AContent = $_POST['AContent'];
            $UserID = $_SESSION['id'];

            // Call the function to insert the answer
            $insertAnswers = insertAnswers($pdo, $AContent, $UserID, $QuestionID);

            if ($insertAnswers) {
                header('Location: questions.php');
                exit();
            } else {
                $title = 'An error has occurred';
                $output = 'Failed to submit your answer. Please try again.';
            }
        } catch (PDOException $e) {
            $title = 'An error has occurred';
            $output = 'Database error: ' . $e->getMessage();
        }
    }
}

ob_start();
include 'templates/addanswers.html.php';
$title = 'Reply Questions';
$output = ob_get_clean();
include 'templates/layout.html.php';
?>
