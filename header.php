<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="./style/global.css">
    <link rel="stylesheet" href="./style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<header class="header">
       
        <nav class="main-nav">
          <button class="nav-button" aria-label="Open catalog">
            <img class="vector" src="./images/icons/menu.svg" alt="" />
            <span class="text-wrapper">КАТАЛОГ</span>
          </button>
          <img class="logo" src="./images/logot.png" alt="LuxuryWatches logo" />
          <div class="right-header">
         
          <form class="search-form" role="search">
            <input type="search" class="search-input" placeholder="Поиск" aria-label="Search products" />
            <button type="submit" class="search-button" aria-label="Submit search">
              <img class="search" src="./images/icons/search.svg" alt="" />
            </button>
          </form>
          <div class="user-actions">
            <button class="action-button" aria-label="Favorites">
              <img class="heart" src="./images/icons/heart.svg" alt="" />
            </button>
            <button class="action-button" aria-label="Shopping bag">
              <img class="bag" src="./images/icons/bag.svg" alt="" />
            </button>
            <button class="action-button" aria-label="User account">
              <img class="person-circle" src="./images/icons//person-circle.svg" alt="" />
            </button>
          </div>
          </div>
        </nav>
        <nav class="secondary-nav">
        <ul>
          <li><a href="#about">О нас</a></li>
          <li><a href="#brands">Бренды</a></li>
          <li><a href="#contacts">Контакты</a></li>
          <li><a href="#warranty">Гарантия</a></li>
        </ul>
      </nav>
      
      </header>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>