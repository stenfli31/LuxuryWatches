<!DOCTYPE html>
<?php session_start();
require_once 'db.php'; ?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>О нас</title>
    <link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="./style/global.css" />
    <link rel="stylesheet" href="./style/style.css" />
    <link rel="stylesheet" href="./style/media.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'header.php'; ?>

    <main class="d-flex flex-column align-items-center">
        <div class="d-flex flex-column p-5" style="width: 80%;">
            <h2 class="mb-5">Связаться с нами</h2>
            <p class="mb-1">Мы всегда рады помочь вам выбрать идеальные часы и ответить на все вопросы. Свяжитесь с нами удобным для вас способом.</p>
        </div>
        <div class="d-flex flex-column p-5" style="width: 80%;">
            <h2 class="mb-5">Контактная информация</h2>
            <ul>
                <li>Телефон: +7 (800) 555-35-35</li>
                <li>Email: luxury@watches.co</li>
                <li>Адрес: Улица Гоголя 120</li>
                <li>Часы работы: Пн–Пт: 10:00–19:00, Сб: 11:00–17:00</li>
            </ul>
        </div>

        
 
    </main>

    <?php include "footer.html" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./JS/main.js"></script>
</body>

</html>