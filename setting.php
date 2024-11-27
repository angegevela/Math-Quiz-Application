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
    <style>
        #wrapper {
            font-family: Monaco, Courier, 'Courier New', monospace;
            margin: 50px auto;
            padding: 30px;
            background: #1E3A8A; /* Deep blue background */
            font-size: 14px;
            width: 100%;
            max-width: 500px;
            box-sizing: border-box;
            color: #fff; /* White text */
            text-shadow: 1px 1px 1px #666;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }

        h1 {
            font-size: 28px;
            color: #fff;
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 18px;
            margin: 10px 0 5px;
        }

        input[type="number"], input[type="checkbox"] {
            margin: 5px 0 10px;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border-radius: 6px;
            border: 1px solid #fff;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        input[type="number"]:focus {
            border: 1px solid #ddd;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.7);
        }

        input[type="checkbox"] {
            margin-right: 10px;
        }

        button {
            font-size: 18px;
            color: #fff;
            background: #000;
            text-shadow: 1px 1px 1px #000;
            border: 1px solid #fff;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 20px;
            text-transform: uppercase;
            background-image: linear-gradient(to bottom, #3b3b3b, #000);
        }

        button:hover {
            color: #ccc;
            background: #444;
        }

        body {
            background: url('bg.gif') no-repeat center center fixed; /* Add the GIF */
            background-size: cover; /* Ensure it covers the entire viewport */
            height: 100vh;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <h1>Math Quiz Settings</h1>
        <form method="POST">
            <label for="num_questions">Number of Questions:</label>
            <input type="number" name="num_questions" id="num_questions" value="10" min="1" required>

            <label>Operands:</label>
            <input type="checkbox" name="operands[]" value="+" checked> +<br>
            <input type="checkbox" name="operands[]" value="-" checked> -<br>
            <input type="checkbox" name="operands[]" value="*" checked> *<br>
            <input type="checkbox" name="operands[]" value="/" checked> /<br>
            <input type="checkbox" name="operands[]" value="%" checked> %<br>

            <label for="max_value">Minimum Value:</label>
            <input type="number" name="max_value" id="max_value" value="100" min="1" required>
            <label for="max_value">Maximum Value:</label>
            <input type="number" name="max_value" id="max_value" value="100" min="1" required>

            <button type="submit">Start Quiz</button>
        </form>
    </div>
</body>
</html>
