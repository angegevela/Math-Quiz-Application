<?php
session_start();

// Redirect to settings if the quiz session isn't set
if (!isset($_SESSION['questions']) || !isset($_SESSION['current_question'])) {
    header('Location: settings.php');
    exit;
}

// Process the answer submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answer'])) {
    $currentQuestionIndex = $_SESSION['current_question'];
    $questions = $_SESSION['questions'];
    $currentQuestion = $questions[$currentQuestionIndex];

    // Validate the submitted answer
    $submittedAnswer = $_POST['answer'];
    $correctAnswer = $currentQuestion['answer'];

    if ($submittedAnswer == $correctAnswer) {
        $_SESSION['correct']++;
    } else {
        $_SESSION['wrong']++;
    }

    // Move to the next question
    $_SESSION['current_question']++;

    // Check if the quiz is complete
    if ($_SESSION['current_question'] >= count($_SESSION['questions'])) {
        header('Location: results.php');
        exit;
    }
}

// Retrieve the current question and answers
$currentQuestionIndex = $_SESSION['current_question'];
$questions = $_SESSION['questions'];
$currentQuestion = $questions[$currentQuestionIndex];
$question = $currentQuestion['question'];
$correctAnswer = $currentQuestion['answer'];

// Generate multiple-choice answers
$choices = [$correctAnswer];
for ($i = 1; $i <= 3; $i++) {
    do {
        $fakeAnswer = rand($correctAnswer - 10, $correctAnswer + 10);
    } while (in_array($fakeAnswer, $choices)); // Ensure unique choices
    $choices[] = $fakeAnswer;
}

shuffle($choices); // Randomize answer order
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Math Quiz</title>
    <style>
        #wrapper {
            font-family: Monaco, Courier, 'Courier New', monospace;
            margin: 50px auto;
            padding: 30px;
            background: #4D6879; /* Main color of the form */
            font-size: 14px;
            width: 100%;
            max-width: 500px;
            box-sizing: border-box;
            color: #fff;
            text-shadow: 1px 1px 1px #666;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }

        h1 {
            text-align: center;
            font-family: Monaco, Courier, 'Courier New', monospace;
            font-size: 28px;
            color: #fff;
            margin-bottom: 20px;
        }

        form {
            text-align: center;
        }

        p {
            font-size: 16px;
            font-family: Monaco, Courier, 'Courier New', monospace;
            color: #fff;
        }

        label {
            display: block;
            font-size: 18px;
            margin: 10px 0;
            text-align: left;
        }

        input[type="radio"] {
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
            background-size: cover;
            height: 100vh;
            margin: 0;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <h1>Math Quiz</h1>
        <form method="POST">
            <p><strong>Question:</strong> <?= $question ?> = ?</p>
            <?php foreach ($choices as $index => $choice): ?>
                <label>
                    <input type="radio" name="answer" value="<?= $choice ?>" required>
                    <?= chr(65 + $index) ?>) <?= $choice ?>
                </label>
            <?php endforeach; ?>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
