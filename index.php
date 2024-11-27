<?php
include('connect.php');

$sql_query = "SELECT username, score, date FROM leaderboard ORDER BY score DESC, date ASC LIMIT 10";
$result = $conn->query($sql_query);
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['close'])) {
        // Perform actions before terminating, if needed
        echo "Process terminated.";

        // Stop script execution
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LeaderBoard</title>
</head>
<body>
<h1>Leaderboard</h1>
    <form method="POST" action="settings.php">
    <button type="submit" name="start_quiz">Start Quiz</button>
    </form>

    <form method="POST">
        <button type="submit" name="close">Close</button>
    </form>
    <table table border='2' cellspacing='2' cellpadding='7', text-align = 'center', style='text-align: center; font-family: Arial, serif;'>
        <thead>
            <tr>
                <th>Rank</th>
                <th>Username</th>
                <th>Score</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                $rank = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $rank++ . "</td>";
                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                    echo "<td>" . $row['score'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No scores available</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>