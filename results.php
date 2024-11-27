<?php 
session_start();
include('connect.php');


// Check if the user has completed the quiz
if (!isset($_SESSION['score'])) {
    header('Location: quiz.php');
    exit;
}

// Get score from session
$score = $_SESSION['score'];

// Calculate rank (this can be adjusted based on difficulty or other criteria)
if ($score >= 85) {
    $rank = 'A';
} elseif ($score >= 40) {
    $rank = 'B';
} elseif ($score >= 20) {
    $rank = 'C';
} else {
    $rank = 'D';
}


?>
