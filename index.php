<?php
include('connect.php');

$sql_query = "SELECT username, score, date FROM leaderboard ORDER BY score DESC, date ASC LIMIT 10";
$result = $conn->query($sql_query);
?>