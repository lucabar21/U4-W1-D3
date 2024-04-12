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

$stmt = $pdo->query('SELECT * FROM users');
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
        <div class="card-body">

            <h5 class="card-title text-center">Lista Utenti</h5>
            <a href='add.php/?id=$user[id]' class='btn btn-success text-center'>Add</a>
            <a href='search.php/' class='btn btn-secondary text-center'>Search</a>
        </div>
    </div>
    <?php

    $limit = 5;
    $query = "SELECT count(*) FROM users";

    $s = $pdo->query($query);
    $total_results = $s->fetchColumn();
    $total_pages = ceil($total_results / $limit);

    if (!isset($_GET['page'])) {
        $page = 1;
    } else {
        $page = $_GET['page'];
    }



    $starting_limit = ($page - 1) * $limit;
    $show = "SELECT * FROM users ORDER BY id DESC LIMIT ?,?";

    $r = $pdo->prepare($show);
    $r->execute([$starting_limit, $limit]);

    while ($res = $r->fetch(PDO::FETCH_ASSOC)):
        ?>
        <div class='d-flex flex-column gap-3'>
            <div class='d-flex p-2 gap-3 align-items-baseline justify-content-between'>
                <p class='card-text'><?= $res['username'] ?></p>
                <p class='card-text'><?= $res['email'] ?></p>
                <div class='d-flex gap-1'>
                    <a href='details.php/?id=<?= $res['id'] ?>' class='btn btn-primary'>Go</a>
                    <a href='edit.php/?id=<?= $res['id'] ?>' class='btn btn-warning'>Edit</a>
                    <a href='delete.php/?id=<?= $res['id'] ?>' class='btn btn-danger'>Delete</a>
                </div>
            </div>
        <?php endwhile ?>



        <div class="d-flex gap-2 mx-auto">
            <?php for ($page = 1; $page <= $total_pages; $page++): ?>
                <a href='<?php echo "?page=$page"; ?>' class="links"><?php echo $page; ?>
                </a>
            <?php endfor; ?>
        </div>
        <script>

        </script>
</body>

</html>