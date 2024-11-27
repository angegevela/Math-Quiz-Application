<?php 
session_start();
include('connect.php');


// Check if the user has completed the quiz
if (!isset($_SESSION['score'])) {
    header('Location: quiz.php');
    exit;
}



?>
