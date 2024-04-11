<?php

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

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    $idUser = isset($_GET['id']) ? intval($_GET['id']) : null;

    if ($idUser !== null) {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$idUser]);

        $userDetails = $stmt->fetch();
    } else {
        throw new Exception("ID utente non fornito.");
    }
} catch (PDOException $e) {
    echo "Errore di connessione al database: " . $e->getMessage();
} catch (Exception $e) {
    echo "Errore: " . $e->getMessage();
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
    <title>Dettagli Utente</title>
    <style>
        body {
            font-family: "Roboto", sans-serif;
        }
    </style>
</head>

<body>
    <div class="card" key="<?= $userDetails['id'] ?>">
        <div class="card-body">
            <h5 class="card-title">Dettaglio utente</h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">ID: <?= $userDetails['id'] ?></h6>
            <p class="card-text">Email: <?= $userDetails['email'] ?></p>
            <p class="card-text">Password: <?= $userDetails['password'] ?></p>
        </div>
    </div>
</body>

</html>