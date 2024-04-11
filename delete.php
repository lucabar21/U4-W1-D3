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

$pdo = new PDO($dsn, $user, $pass, $options);

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('DELETE FROM users WHERE id = ?');
    $stmt->execute([$_GET['id']]);

    header("Location: /U4-W1-D3/Esercizio%201/");
    exit;
} else {
    echo 'Impossibile eliminare';
}
