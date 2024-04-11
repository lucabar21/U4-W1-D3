<?php

$host = 'localhost';
$db = 'ifoa_firstdb';
$user = 'root';
$pass = '';

try {
    $dsn = "mysql:host=$host;dbname=$db";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    die("Errore di connessione al database: " . $e->getMessage());
}

if (isset($_POST["username"], $_POST['email'], $_POST['password'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = [];

    if (empty($username)) {
        $errors['username'] = 'Il campo username è richiesto.';
    }
    if (empty($email)) {
        $errors['email'] = 'Il campo email è richiesto.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email non valida.';
    }
    if (empty($password)) {
        $errors['password'] = 'Il campo password è richiesto.';
    } elseif (strlen($password) < 12 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $errors['password'] = 'La password deve contenere almeno 12 caratteri e avere almeno una maiuscola e un numero.';
    }

    if (!empty($errors)) {
        echo '<pre>' . print_r($errors, true) . '</pre>';
    } else {
        $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
        $stmt->execute(['username' => $username, 'email' => $email, 'password' => $password]);

        header("Location:/U4-W1-D3/Esercizio%201/");
        exit();
    }
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
        <h3 class="text-center">Aggiungi utente</h3>
        <form action="" method="post">
            <div class="mb-3">
                <label for="exampleInputUsername" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="exampleInputUsername"
                    aria-describedby="usernameHelp" placeholder="Rossi" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" id="exampleInputEmail" aria-describedby="emailHelp"
                    placeholder="example@email.com" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword" class="form-label">Password</label>
                <input type="text" class="form-control" name="password" id="exampleInputPassword"
                    aria-describedby="passwordHelp" placeholder="***********" required>
            </div>
            <div class="d-flex justify-content-center"><button class="btn btn-primary">Invia</button></div>
        </form>
    </div>
    <script>

    </script>
</body>

</html>