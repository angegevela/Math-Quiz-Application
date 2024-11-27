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

// Handle form submission to save user details
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
    $username = $_POST['username'];
    $date = date('Y-m-d H:i:s'); // Current date and time

    // Insert the score into the database
    $stmt = $conn->prepare("INSERT INTO leaderboard (username, score, date) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $username, $score, $date);
    $stmt->execute();
    
    // Redirect to leaderboard after saving score
    header('Location: index1.php');
    exit;
}
?>
