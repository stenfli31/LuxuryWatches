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
            <h2 class="mb-5">Наши бренды</h2>
            <p class="mb-5">Мы с гордостью представляем тщательно отобранную коллекцию оригинальных часов от ведущих мировых брендов. 
                Каждый бренд — это история, технологии и непревзойдённое качество. Выберите любимый бренд и откройте для себя коллекцию, 
                соответствующую вашему стилю и статусу.</p>
        </div>
        
  <?php 
  $stmt = $pdo->query("SELECT * FROM brands");
  $brands = $stmt ->fetchAll(PDO::FETCH_ASSOC);
  ?>

    <div class="">
    <ul>
    <?php foreach ($brands as $brand): ?>
      <li>
        <a href="catalog.php?brand[]=<?=$brand['id'] ?>">
          <?= htmlspecialchars($brand['brand']) ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
    

</div>
    </main>

    <?php include "footer.html" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./JS/main.js"></script>
</body>

</html>