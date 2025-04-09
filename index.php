<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LuxuryWatches - Время в своем лучшем проявлении</title>
    <link rel="stylesheet" href="./style/global.css" />
    <link rel="stylesheet" href="./style/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="frame">
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
          <p>
            Добро пожаловать в LuxuryWatches — пространство, где стиль, точность и престиж соединяются в каждом тике. Мы
            предлагаем коллекцию эксклюзивных часов от ведущих мировых брендов — для тех, кто ценит безупречное качество
            и непревзойденную элегантность.
          </p>
        </section>
        <section class="popular-models">
          <h2>Популярные модели</h2>
          <div class="product-grid">
            <article class="product-card">
              <img
                src="https://c.animaapp.com/m9e8fd6qsdWEoD/img/tissot-t-classic-13.png"
                alt="Tissot T-Classic"
                class="product-image"
              />
              <h3 class="product-title">Tissot T-Classic</h3>
              <p class="product-price">484 000 ₸</p>
              <button class="favorite-button" aria-label="Add to favorites">
                <img src="https://c.animaapp.com/m9e8fd6qsdWEoD/img/vector.svg" alt="" />
              </button>
            </article>
            `
            <!-- Repeat the product-card structure for the other 3 popular models -->
          </div>
        </section>
        <section class="women-watches">
          <h2>ЖЕНСКИЕ ЧАСЫ</h2>
          <img
            src="https://c.animaapp.com/m9e8fd6qsdWEoD/img/womanwatch-1.png"
            alt="Women's watch collection"
            class="category-image"
          />
          <div class="product-grid">
            <!-- Repeat the product-card structure for the 8 women's watches -->
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
              alt="LuxuryWatches logo"
            />
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
