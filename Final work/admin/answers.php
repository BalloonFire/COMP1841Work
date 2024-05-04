<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['id']) || $_SESSION['admin'] !== 'Y') {
    header('Location: ../login.php');
    exit();
}
try {
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunctions.php';

    if (isset($_GET['id'])) {
        $questionId = $_GET['id'];

    // Fetch the question details using the getQuestion function
    $question = getQuestionContent($pdo, $questionId);

    if ($question) {
        $answers = allAnswers($pdo, $questionId);
        $title = 'Answer List';
        ob_start();
        include '../templates/answers.html.php';
        $output = ob_get_clean();
    } else {
        // Handle the case where the question does not exist
        $title = 'Error';
        $output = 'Question does not exist.';
    }
} else {
    // Handle the case where 'id' is not provided in the URL
    $title = 'Error';
    $output = 'Question ID is missing in the URL.';
}
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}
include '../templates/adminlayout.html.php';
?>