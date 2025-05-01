<!DOCTYPE html>
<?php session_start();

  ?>

  <html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LuxuryWatches - Время в своем лучшем проявлении</title>

    <link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="./style/global.css" />
    <link rel="stylesheet" href="./style/style.css" />
    <link rel="stylesheet" href="./style/media.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body>

    <div class="frame">
      <?php require_once 'db.php'; ?>
      <?php include 'header.php'; ?>


      <main>
        <section class="hero">
          <video class="hero-video" autoplay loop muted>
            <source src="./videos/promoVideo.webm" type="video/webm" />
            Your browser does not support the video tag.
          </video>
        </section>






        <section class="intro">
          <h1>LuxuryWatches — Время в своем лучшем проявлении</h1>
          <p style="width: 90%; text-align: center;">
            Добро пожаловать в LuxuryWatches — пространство, где стиль, точность и престиж соединяются в каждом тике. Мы
            предлагаем коллекцию эксклюзивных часов от ведущих мировых брендов — для тех, кто ценит безупречное качество
            и непревзойденную элегантность.
          </p>
        </section>

        <?php
        $stmt = $pdo->query("SELECT * FROM products LIMIT 4");
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        function formatPrc($price)
        {
          return number_format($price, 0, ".", " ") . ' ₸';
        }
        ?>

        <section class="watch-category2">
          <div style="width: 50%; justify-content:center;" class="d-flex">
          <a href="catalog.php?category[]=1>" class="product-card-link">
            <img src="./images/manWatch.png" alt="Мужские часы" class="category-image">
          </a>
          </div>
          <div style="width: 50%;" class="d-flex  justify-content-center">
            <div class="product-grid ">
              <?php
              $img_path = "./images/";
              if (!empty($products)):
                foreach ($products as $product): ?>
                  <div class="product-card">
                    <a href="product.php?id=<?= $product['id'] ?>" class="product-card-link">
                      <img
                        src="<?= $img_path . $product['product_img'] ?>"
                        alt="<?= htmlspecialchars($product['product_name']) ?>"
                        class="product-image" /></a>
                    <h3 class="product-title"><?= htmlspecialchars($product['product_name']) ?></h3>
                    <p class="product-price"><?= formatPrc($product['price']) ?></p>
                    <button class="favorite-button" aria-label="Add to favorites">
                      <img src="./images/icons/heart.svg" alt="" class="heart" data-hover="./images/icons/heart-fill.svg" />
                    </button>
                  </div>
                <?php endforeach; ?>
              <?php else: ?>
                <p>Нет товаров для отображения</p>
              <?php endif; ?>
            </div>
          </div>
        </section>
        <section class="section-slider">

          <div id="myCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">

            <div class="carousel-indicators">
              <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
              <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1"></button>
              <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2"></button>
            </div>

            <div class="carousel-inner carouselCustom">
              <div class="carousel-item active">
                <img src="./images/promoSlide.jpg" class="d-block w-100" alt="Слайд 1">
              </div>
              <div class="carousel-item">
                <img src="./images/videoframe_110.png" class="d-block w-100" alt="Слайд 2">
              </div>
              <div class="carousel-item">
                <img src="./images/promoSlide.jpg" class="d-block w-100" alt="Слайд 3">
              </div>
            </div>
          </div>

        </section>
        <section class="watch-category2">

          <div style="width: 50%;" class="d-flex  justify-content-center">
            <div class="product-grid ">
              <?php
              $img_path = "./images/";
              if (!empty($products)):
                foreach ($products as $product): ?>

                  <div class="product-card">
                    <a href="product.php?id=<?= $product['id'] ?>" class="product-card-link">
                      <img
                        src="<?= $img_path . $product['product_img'] ?>"
                        alt="<?= htmlspecialchars($product['product_name']) ?>"
                        class="product-image" /> </a>
                    <h3 class="product-title"><?= htmlspecialchars($product['product_name']) ?></h3>
                    <p class="product-price"><?= formatPrc($product['price']) ?></p>
                    <button class="favorite-button" aria-label="Add to favorites">
                      <img src="./images/icons/heart.svg" alt="" class="heart" data-hover="./images/icons/heart-fill.svg" />
                    </button>
                  </div>

                <?php endforeach; ?>
              <?php else: ?>
                <p>Нет товаров для отображения</p>
              <?php endif; ?>
            </div>
          </div>
          <div style="width: 50%; justify-content:center;" class="d-flex">
          <a href="catalog.php?category[]=2>" class="product-card-link">
            <img src="./images/womanWatch.png" alt="Женские часы" class="category-image">
          </a>
          </div>
        </section>



      </main>
      <?php include "footer.html" ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./JS/main.js"></script>
  </body>

  </html>