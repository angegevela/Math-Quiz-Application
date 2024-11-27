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
<style>
        body {
            background: url('bg.gif') no-repeat center center fixed; /* Add the GIF */
            background-size: cover; /* Ensure it covers the entire viewport */
            height: 100vh;
            font-family: Monaco, Courier, 'Courier New', monospace;
        }
        #wrapper {
            margin: 50px auto;
            padding: 30px;
            background: #4D6879; /* You can change the main color of the form here. */
            font-size: 14px;
            width: 100%;
            max-width: 500px;
            box-sizing: border-box;
            border-radius: 10px;
        }
        h1 {
            text-align: center;
            font-size: 36px;
            color: #fff;
            text-shadow: 1px 1px 2px #000;
        }
        label {
            display: block;
            font-size: 24px;
            padding: 13px 0;
            color: #fff;
            text-shadow: 1px 1px 1px #666;
        }
        input {
            height: 18px;
            padding: 20px;
            width: 100%;
            box-sizing: border-box;
            border-radius: 6px;
            box-shadow: 0 0 10px #444;
            border: 1px solid #fff;
        }
        input#submit {
            text-align: center;
            color: #fff;
            height: 50px;
            font-size: 18px;
            text-transform: uppercase;
            margin-top: 20px;
            border: 1px solid #000;
            background: linear-gradient(top, #3b3b3b 0%, #000000 100%);
            opacity: 0.5;
        }
        input#submit:hover {
            color: #ccc;
            cursor: pointer;
            opacity: 0.8;
        }
        table {
            margin: 20px auto;
            width: 90%;
            border-collapse: collapse;
            text-align: center;
            background: #f8f8f8;
            box-shadow: 0 0 10px #444;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            font-size: 16px;
        }
        th {
            background: #4D6879;
            color: #fff;
        }
        tr:nth-child(even) {
            background: #eee;
        }
        button {
            display: block;
            margin: 10px auto;
            padding: 10px 20px;
            font-size: 18px;
            background: #4D6879;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-transform: uppercase;
            box-shadow: 0 0 5px #444;
        }
        button:hover {
            background: #3b3b3b;
        }
    </style>
<body>
<h1>Leaderboard</h1>
    <form method="GET" action="setting.php">
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