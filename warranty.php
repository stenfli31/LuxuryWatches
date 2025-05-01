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
            <h2 class="mb-5">Гарантия подлинности и качества</h2>
            <p class="mb-1">Каждая модель часов, представленная в нашем каталоге, проходит строгий отбор и поступает только от официальных поставщиков.
                 Мы уверены в качестве каждого экземпляра.</p>
        </div>
        <div class="d-flex flex-column p-5" style="width: 80%;">
            <h2 class="mb-5">Что мы гарантируем</h2>
            <ul style="list-style-type: disc;">
                <li>Только оригинальные часы с официальными гарантийными документами</li>
                <li>Гарантия от 1 до 5 лет в зависимости от бренда</li>
                <li>Возможность возврата и обмена согласно законодательству</li>
                <li>Сервисное обслуживание и помощь в ремонте</li>
            </ul>
        </div>

        
 
    </main>

    <?php include "footer.html" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./JS/main.js"></script>
</body>

</html>