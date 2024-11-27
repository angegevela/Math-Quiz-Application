<?php
include('connect.php');

$sql_query = "SELECT username, score, date FROM leaderboard ORDER BY score DESC, date ASC LIMIT 10";
$result = $conn->query($sql_query);
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

</body>
</html>