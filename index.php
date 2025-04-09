<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LuxuryWatches - Время в своем лучшем проявлении</title>
  <link rel="stylesheet" href="./style/global.css" />
  <link rel="stylesheet" href="./style/style.css" />
  <link rel="stylesheet" href="./style/media.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="frame">
    <?php require_once 'db.php'; ?>
    <?php include 'header.php'; ?>
    <a href="bdForm.php" class="btn btn-primary admin">Админ</a>
    <main>
      <section class="hero">
        <video class="hero-video" autoplay loop muted>
          <source src="./videos/promoVideo.webm" type="video/webm" />
          Your browser does not support the video tag.
        </video>
      </section>
      <section class="intro">
        <h1>LuxuryWatches — Время в своем лучшем проявлении</h1>
        <p>
          Добро пожаловать в LuxuryWatches — пространство, где стиль, точность и престиж соединяются в каждом тике. Мы
          предлагаем коллекцию эксклюзивных часов от ведущих мировых брендов — для тех, кто ценит безупречное качество
          и непревзойденную элегантность.
        </p>
      </section>
      <section class="section-slider mb-5">
        <div class="container mt-5 d-flex justify-content-center">
          <div id="myCarousel" class="carousel slide" style="width: 1920px;" data-bs-ride="carousel" data-bs-interval="3000">

            <!-- Точки (индикаторы) -->
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
              <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1"></button>
              <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2"></button>
            </div>

            <!-- Слайды -->
            <div class="carousel-inner" style="height: 400px; ">
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
        </div>
      </section>

      <?php
      $stmt = $pdo->query("SELECT * FROM products LIMIT 4");
      $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
      function formatPrc($price)
      {
        return number_format($price, 0, ".", " ") . ' ₸';
      }
      ?>

      <section class="watch-category">
        <div class="img-container">
          <img
            src="./images/manWatch.png"
            alt="Man's watch collection"
            class="category-image p-3" />
        </div>
        <div class="d-flex  justify-content-start ">
          <div class="product-grid p-3 ">

            <?php
            $img_path = "./images/";
            if (!empty($products)):
              foreach ($products as $product): ?>
                <div class="product-card">

                  <img
                    src="<?= $img_path . $product['product_img'] ?>"
                    alt="<?= htmlspecialchars($product['product_name']) ?>"
                    class="product-image" />
                  <h3 class="product-title"><?= htmlspecialchars($product['product_name']) ?></h3>
                  <p class="product-price"><?= formatPrc($product['price']) ?></p>
                  <button class="favorite-button" aria-label="Add to favorites">
                    <img src="https://c.animaapp.com/m9e8fd6qsdWEoD/img/vector.svg" alt="" />
                  </button>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <p>Нет товаров для отображения</p>
            <?php endif; ?>
          </div>
        </div>
      </section>
      <section class="women-watches">
        <h2>ЖЕНСКИЕ ЧАСЫ</h2>
        <img
          src="https://c.animaapp.com/m9e8fd6qsdWEoD/img/womanwatch-1.png"
          alt="Women's watch collection"
          class="category-image" />

        <div class="product-grid">
          <div class="product-card">
            <img
              src="https://c.animaapp.com/m9e8fd6qsdWEoD/img/tissot-t-classic-13.png"
              alt="Tissot T-Classic"
              class="product-image" />
            <h3 class="product-title">Tissot T-Classic</h3>
            <p class="product-price">484 000 ₸</p>
            <button class="favorite-button" aria-label="Add to favorites">
              <img src="https://c.animaapp.com/m9e8fd6qsdWEoD/img/vector.svg" alt="" />
            </button>
          </div>
        </div>

      </section>
    </main>
    <footer>
      <div class="footer-content">
        <div class="footer-section">
          <h3>Навигация</h3>
          <ul>
            <li><a href="#">Главная</a></li>
            <li><a href="#">Каталог</a></li>
            <li><a href="#">О нас</a></li>
            <li><a href="#">Личный кабинет</a></li>
          </ul>
        </div>
        <div class="footer-section">
          <h3>Контакты</h3>
          <p>Телефон: 8800553535</p>
          <p>Email: luxury@watches.co</p>
          <p>Адрес: Улица Гоголя 120</p>
        </div>
        <div class="footer-section">
          <img
            class="logo-footer"
            src="https://c.animaapp.com/m9e8fd6qsdWEoD/img/logo-2.png"
            alt="LuxuryWatches logo" />
        </div>
      </div>
      <div class="copyright">
        <p>Все права защищены © LuxuryWatches™ 2025</p>
      </div>
    </footer>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>