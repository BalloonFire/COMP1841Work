<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['id']) || $_SESSION['admin'] !== 'Y') {
    header('Location: ../login.php');
    exit();
}

// Include necessary files
include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';

// Define current page and questions per page
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$questionsPerPage = 5; // Number of questions to display per page

// Calculate offset for fetching questions
$offset = ($currentPage - 1) * $questionsPerPage;

try {
    // Fetch total questions count
    $totalQuestions = totalQuestions($pdo);

    // Fetch all module names
    $modules = allModules($pdo);

    // Define $orderBy variable with a default value
    $orderBy = 'newest'; // Set the default sort order to 'newest'

    // Fetch questions based on search input, filter, and sorting order
    if (!empty($_GET['searchInput'])) {
        // Search by keywords
        $searchInput = $_GET['searchInput'];
        if(isset($_GET['sortOrder']) && ($_GET['sortOrder'] == 'newest' || $_GET['sortOrder'] == 'oldest')) {
            // Sort questions by timestamp
            $orderBy = $_GET['sortOrder']; // Update $orderBy with the provided value
        }
        $questions = searchQuestionsByKeywords($pdo, $searchInput, $orderBy, $offset, $questionsPerPage);
        // Update total questions count based on search results
        $totalQuestions = count(searchQuestionsByKeywords($pdo, $searchInput, $orderBy, 0, PHP_INT_MAX)); // Get total count without pagination
    } elseif (!empty($_GET['moduleFilter'])) {
        // Filter by module
        $moduleID = $_GET['moduleFilter'];
        if(isset($_GET['sortOrder']) && ($_GET['sortOrder'] == 'newest' || $_GET['sortOrder'] == 'oldest')) {
            // Sort questions by timestamp
            $orderBy = $_GET['sortOrder']; // Update $orderBy with the provided value
        }
        $questions = filterQuestionsByModule($pdo, $moduleID, $orderBy, $offset, $questionsPerPage);
        // Update total questions count based on filtered results
        $totalQuestions = count(filterQuestionsByModule($pdo, $moduleID, $orderBy, 0, PHP_INT_MAX)); // Get total count without pagination
    } else {
        // Fetch all questions
        if(isset($_GET['sortOrder']) && ($_GET['sortOrder'] == 'newest' || $_GET['sortOrder'] == 'oldest')) {
            // Sort questions by timestamp
            $orderBy = $_GET['sortOrder']; // Update $orderBy with the provided value
            $questions = sortQuestionsByTimestamp($pdo, $orderBy, $offset, $questionsPerPage);
        } elseif (isset($_GET['sortOrder']) && $_GET['sortOrder'] == 'none') {
            // Do not sort questions, fetch them as they are
            $questions = allQuestions($pdo, $offset, $questionsPerPage);
        } else {
            // Default: Fetch questions sorted by newest first
            $questions = sortQuestionsByTimestamp($pdo, 'newest', $offset, $questionsPerPage);
        }
    }

    // Calculate total pages based on total questions count and questions per page
    $totalPages = ceil($totalQuestions / $questionsPerPage);

    ob_start();
    include '../templates/questions.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

$title = 'Question list';
include '../templates/adminlayout.html.php';
?>
