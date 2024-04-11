<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["username"])) {
        $username = $_POST['username'];

        // $email = $_POST['email'];
        // $password = $_POST['password'];

        $errors = [];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email non valida';
        }

        if (strlen($password) < 12 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
            $errors['password'] = 'La password deve contenere almeno 12 caratteri e avere almeno una maiuscola e un numero';
        }

        if ($errors == []) {
            header('Location: /U4-W1-D2/Esercizio 1/success.php');
            exit();
        }
        echo '<pre>' . print_r($errors) . '</pre>';
    }
}

$host = 'localhost';
$db = 'ifoa_firstdb';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

$pdo = new PDO($dsn, $user, $pass, $options);
$userID = $_GET['id'];

if (isset($username)) {
    $stmt = $pdo->prepare('UPDATE users SET name = :name WHERE id = ?');
    $stmt->execute(['name' => $username, $userID]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <title>U4-W1-D3</title>
    <style>
        body {
            font-family: "Roboto", sans-serif;
        }
    </style>
</head>

<body>
    <div class="p-2">
        <form action="" method="post">
            <div class="mb-3">
                <label for="exampleInputUsername" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="exampleInputUsername"
                    aria-describedby="usernameHelp" placeholder="Rossi" required>
            </div>
            <div class="d-flex justify-content-center"><button class="btn btn-primary">Invia</button></div>
        </form>
    </div>
    <script>

    </script>
</body>

</html>