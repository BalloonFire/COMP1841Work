<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['id']) || $_SESSION['admin'] !== 'Y') {
    header('Location: ../login.php');
    exit();
}
try{
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunctions.php';
    $deletedQuestion = getQuestion($pdo, $_POST['id']);
    deleteQuestions($pdo, $_POST['id']);

    if (file_exists($deletedQuestion['image']))
        unlink($deletedQuestion['image']);
    
    header('location: ../admin/questions.php');
}catch(PDOException $e) {
$title= 'An error has occured';
$output = 'Unable to connect to delete questions: ' . $e->getMessage();
}
ob_start();
include '../templates/deletequestions.html.php';
$output = ob_get_clean();
$title = 'Delete Question';
include '../templates/adminlayout.html.php';
?>