<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$name = trim($_POST["name"] ?? "");
$fatherName = trim($_POST["father_name"] ?? "");
$email = trim($_POST["email"] ?? "");
$phone = trim($_POST["phone"] ?? "");
$age = filter_var($_POST["age"] ?? "", FILTER_VALIDATE_INT);
$address = trim($_POST["address"] ?? "");
$success = false;

if ($name === "" || $fatherName === "" || $email === "" || $phone === "" || $age === false || $age < 1 || $age > 120) {
    $message = "Check the required fields and try submitting the form again.";
} else {
    try {
        $connection = mysqli_connect("localhost", "root", "", "student_db");
        $statement = mysqli_prepare($connection, "INSERT INTO students (name, father_name, email, phone, age, address) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($statement, "ssssis", $name, $fatherName, $email, $phone, $age, $address);
        mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);
        mysqli_close($connection);

        $success = true;
        $message = "The student has been added to the registry.";
    } catch (mysqli_sql_exception $exception) {
        $message = "We couldn't save this record. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f4f6f2">
    <title><?= $success ? "Record saved" : "Unable to save record" ?> | Student Registry</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Newsreader:opsz,wght@6..72,500;6..72,600&display=swap" rel="stylesheet">
    <style>
        :root {
            color-scheme: light;
            font-family: "DM Sans", sans-serif;
            color: #1d302d;
            background: #f4f6f2;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-width: 320px;
            min-height: 100vh;
            margin: 0;
            display: grid;
            place-items: center;
            padding: 1.25rem;
        }

        main {
            width: min(100%, 36rem);
            padding: clamp(2rem, 7vw, 4rem);
            border: 1px solid #d4ddd8;
            border-top: 4px solid <?= $success ? "#28745e" : "#b95135" ?>;
            background: #fff;
            text-align: center;
        }

        .status-icon {
            width: 3.5rem;
            aspect-ratio: 1;
            margin: 0 auto 1.5rem;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: #e6f1ea;
            color: #1f624f;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .status-icon.error {
            background: #fbede8;
            color: #b95135;
        }

        .eyebrow {
            margin: 0 0 0.6rem;
            color: #b95135;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            font-family: "Newsreader", Georgia, serif;
            font-size: clamp(2.3rem, 7vw, 3.2rem);
            font-weight: 500;
            line-height: 1.05;
        }

        .message {
            margin: 0.8rem 0 1.75rem;
            color: #667670;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .actions {
            display: grid;
            gap: 0.75rem;
        }

        .button {
            min-height: 3rem;
            padding: 0.8rem 1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #1f624f;
            border-radius: 3px;
            background: #1f624f;
            color: #fff;
            font-size: 0.9rem;
            font-weight: 700;
            text-decoration: none;
        }

        .button:hover {
            background: #174c3e;
        }

        .button.secondary {
            background: #fff;
            color: #1f624f;
        }

        .button.secondary:hover {
            background: #e8f0eb;
        }

        a:focus-visible {
            outline: 3px solid #d08b42;
            outline-offset: 3px;
        }
    </style>
</head>
<body>
    <main>
        <div class="status-icon<?= $success ? "" : " error" ?>" aria-hidden="true"><?= $success ? "&#10003;" : "!" ?></div>
        <p class="eyebrow">Student Registry</p>
        <h1><?= $success ? "Record saved" : "Record not saved" ?></h1>
        <p class="message"><?= htmlspecialchars($message, ENT_QUOTES, "UTF-8") ?></p>
        <nav class="actions" aria-label="Next steps">
            <a class="button" href="index.php"><?= $success ? "Enter another student record" : "Return to registration form" ?></a>
            <a class="button secondary" href="lecweek7.php">View student records</a>
        </nav>
    </main>
</body>
</html>