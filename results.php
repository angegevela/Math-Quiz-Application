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



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
</head>
<body>
    <h1>Quiz Completed!</h1>
    <p>Your Score: <?= $score ?> / 20</p>
    <p>Your Rank: <?= $rank ?></p>

    <form method="POST">
        <label for="username">Enter Your Username:</label>
        <input type="text" name="username" id="username" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
