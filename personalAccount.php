<!DOCTYPE html>
<?php session_start() ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="./style/global.css" />
    <link rel="stylesheet" href="./style/style.css" />
    <link rel="stylesheet" href="./style/media.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php
   

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        session_destroy();
        header("Location: index.php");
        exit;
    }


    ?>
<? include 'header.php' ?>
<div style="height: 45%;">
    <h1 class="text-center fs-3 mt-5">Добро пожаловать, <?= $_SESSION['username'] ?>!</h1>
    <div class="card col-10 col-md-5 mt-5 ms-3 mb-5">
        <div class="car-body col-12">
            <div class="row mb-3 card-text">
                <p class="ms-3 mt-3">Имя пользователя: <?= $_SESSION['username'] ?></p>
            </div>
            <div class="row">
                <p class="ms-3">email: <?= $_SESSION['email'] ?></p>
            </div>
        </div>
        <form method="POST" class="d-flex justify-content-end me-3 mb-3">
            <button type="submit" class="btn btn-danger">Выйти</button>
        </form>
    </div>
    </div>
<? include 'footer.html' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>