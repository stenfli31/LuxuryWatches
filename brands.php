<!DOCTYPE html>
<?php session_start(); ?>
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
            <h2 class="mb-5">О нас</h2>
            <p class="mb-5">Luxury Watches — это не просто интернет-магазин. Это место, где время становится искусством, а каждый тик — отражение стиля, вкуса и индивидуальности.
                Мы специализируемся на продаже оригинальных часов класса премиум и люкс от всемирно известных брендов: Rolex, Omega, TAG Heuer, Patek Philippe, Audemars Piguet,
                 Hublot, Tissot, Longines и многих других. Наш каталог тщательно отобран, и каждый экземпляр — это идеальное сочетание технологий, традиций и статуса.</p>
        </div>
        <div class="d-flex flex-column p-5" style="width: 80%;">
            <h2 class="mb-5">Почему выбирают нас?</h2>
            <ul style="list-style-type: disc;">
                <li>Оригинальные часы — только подлинные изделия от официальных поставщиков</li>
                <li>Безопасная и быстрая доставка по всему Казахстану и странам СНГ</li>
                <li>Гарантия подлинности и качества</li>
                <li>Профессиональная консультация — помогаем выбрать идеальные часы под ваш стиль и цели</li>

            </ul>
        </div>
        <div class="d-flex flex-column p-5" style="width: 80%;">
            <h2 class="mb-5">Наша история</h2>
            <p class="mb-5"> История Luxury Watches началась там, где, казалось бы, люксовые бренды не спешат заявлять о себе — в сердце северного Казахстана, в уютном и спокойном городе Костанай.
     Всё началось с увлечения. В 2015 году наш основатель, родом из Костаная, вернувшись из поездки в Европу, привёз свои первые часы TAG Heuer. Это был не просто аксессуар — это был символ новых 
     взглядов, новых стремлений. С тех пор началась история, в которой страсть к часам превратилась в дело жизни.
     Сначала — небольшие поставки по заказу для друзей и знакомых. Затем — первые партнёрства с официальными дистрибьюторами. Потом — свой сайт и идея создать магазин, в котором каждый человек, где 
     бы он ни находился — в Алматы, Астане, Костанае или Москве — мог бы прикоснуться к настоящему часовому искусству.</p>
        </div>
    </main>

    <?php include "footer.html" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./JS/main.js"></script>
</body>

</html>