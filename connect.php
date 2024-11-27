<?php 
$servername = "localhost";
$username = "root";  
$password = "mysqlroot";  
$dbname = "math_quiz"; //In this part I created a new database for my leaderboard


//db overall information given above.
$conn = new mysqli($servername, $username, $password, $dbname);

//condition statement where if the xammpp does not connect in the sql or an error it will go error, meanwhile if it is good it, directs to echo.
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

?>