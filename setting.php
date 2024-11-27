<?php 
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch user-selected settings
    $numQuestions = $_POST['num_questions']; // E.g., 10
    $operands = $_POST['operands']; // E.g., ['+', '-', '*', '/']
    $maxValue = $_POST['max_value']; // E.g., 100
    

    // Initialize questions
    $_SESSION['questions'] = [];
    for ($i = 0; $i < $numQuestions; $i++) {
        // Random operands
        $operand = $operands[array_rand($operands)];
        $a = rand(1, $maxValue);
        $b = rand(1, $maxValue);

        // Avoid division by zero for division or modulus
        if (($operand === '/' || $operand === '%') && $b === 0) {
            $b = rand(1, $maxValue);
        }

        // Generate question and correct answer
        $question = "$a $operand $b";
        eval("\$answer = $a $operand $b;");

        $_SESSION['questions'][] = [
            'question' => $question,
            'answer' => $answer,
        ];
    }

    $_SESSION['current_question'] = 0;
    $_SESSION['correct'] = 0;
    $_SESSION['wrong'] = 0;


    // Redirect to quiz page
    header('Location: quiz.php');
    exit;
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Settings</title>
</head>
<body>
    <h1>Math Quiz Settings</h1>
    <form method="POST">
    <label for="num_questions">Number of Questions:</label>
        <input type="number" name="num_questions" id="num_questions" value="10" min="1" required><br>

        <label>Operands:</label><br>
        <input type="checkbox" name="operands[]" value="+" checked> +<br>
        <input type="checkbox" name="operands[]" value="-" checked> -<br>
        <input type="checkbox" name="operands[]" value="*" checked> *<br>
        <input type="checkbox" name="operands[]" value="/" checked> /<br>
        <input type="checkbox" name="operands[]" value="%" checked> %<br>

        <label for="max_value">Maximum Value:</label>
        <input type="number" name="max_value" id="max_value" value="100" min="1" required><br>

        <button type="submit">Start Quiz</button>


    </form>
</body>
</html>