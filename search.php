<?php

$host = 'localhost';
$db = 'ifoa_firstdb';
$user = 'root';
$pass = '';

$results = [];

$dsn = "mysql:host=$host;dbname=$db";
$pdo = new PDO($dsn, $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
]);

if (isset($_GET["username"])) {
    $username = $_GET['username'];

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username LIKE ?');
    $stmt->execute(['%' . $username . '%']);

    $results = $stmt->fetchAll();

    // header("Location:/U4-W1-D3/Esercizio%201/");
    // exit();
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
        <h3 class="text-center">Ricerca utente</h3>
        <form action="" method="get" class="d-flex align-items-baseline">
            <div class="mb-3">
                <input type="text" class="form-control" name="username" id="exampleInputUsername"
                    aria-describedby="usernameHelp" placeholder="Mario" required>
            </div>
            <div class="d-flex justify-content-center"><button class="btn btn-primary">Search</button></div>
    </div>
    </form>

    <div class="mt-4">
        <h4 class="text-center">Risultati della ricerca</h4>
        <?php
        if (isset($username)) {
            $limit = 5;
            $query = "SELECT count(*) FROM users WHERE username LIKE ?";

            $s = $pdo->prepare($query);
            $s->execute(['%' . $username . '%']);

            $total_results = $s->fetchColumn();
            $total_pages = ceil($total_results / $limit);

            if (!isset($_GET['page'])) {
                $page = 1;
            } else {
                $page = $_GET['page'];
            }



            $starting_limit = ($page - 1) * $limit;
            $show = "SELECT * FROM users WHERE username LIKE ? ORDER BY id DESC LIMIT ?,?";

            $r = $pdo->prepare($show);
            $r->execute(['%' . $username . '%', $starting_limit, $limit]);
            while ($res = $r->fetch(PDO::FETCH_ASSOC)):
                ?>
                <div class='d-flex flex-column gap-3'>
                    <div class='d-flex p-2 gap-3 align-items-baseline justify-content-between'>
                        <p class='card-text'><?= $res['username'] ?></p>
                        <p class='card-text'><?= $res['email'] ?></p>
                        <div class='d-flex gap-1'>
                            <a href='/U4-W1-D3/Esercizio%201/details.php/?id=<?= $res['id'] ?>' class='btn btn-primary'>Go</a>
                            <a href='/U4-W1-D3/Esercizio%201/edit.php/?id=<?= $res['id'] ?>' class='btn btn-warning'>Edit</a>
                            <a href='/U4-W1-D3/Esercizio%201/delete.php/?id=<?= $res['id'] ?>' class='btn btn-danger'>Delete</a>
                        </div>
                    </div>
                <?php endwhile ?>


                <div class="d-flex gap-2 mx-auto">
                    <?php for ($page = 1; $page <= $total_pages; $page++): ?>
                        <a href='<?php echo "?page=$page"; ?>' class="links"><?php echo $page; ?>
                        </a>
                    <?php endfor;
        } ?>

            </div>
        </div>

        <script>

        </script>
</body>

</html>