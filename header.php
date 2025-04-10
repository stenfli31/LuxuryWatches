
<header class="header">
<? if (isset($_SESSION['user_status']) && $_SESSION['user_status'] == '1')
    echo "<a href='bdForm.php' class='btn btn-primary admin'>Admin</a>" ?>
        <nav class="main-nav">
         
          <a href="catalog.php" class="nav-button" aria-label="Open catalog">
            <img class="vector" src="./images/icons/menu.svg" alt="" />
            <span class="text-wrapper">КАТАЛОГ</span>
          
          </a>
          <a href="index.php"><img class="logo" src="./images/logot.png" alt="LuxuryWatches logo" /></a>
          <div class="right-header">
         
          <form method="GET" action="catalog.php" class="search-form" role="search">
            <input name="search" id="search" type="search" class="search-input" placeholder="Поиск" 
            aria-label="Search products"  value="<?php echo $_GET['search'] ?? ''; ?>" />
            <button type="submit" class="search-button" aria-label="Submit search">
              <img class="search" src="./images/icons/search.svg" alt="" />
            </button>
          </form>
          <div class="user-actions">
            <button class="action-button" aria-label="Favorites">
              <img class="heartNav" src="./images/icons/heart.svg" alt="" />
            </button>
            
            <a href="shop-cart.php">
              <button class="action-button" aria-label="Shopping bag">
                <img class="bag" src="./images/icons/bag.svg" alt="" />
              </button>
            </a>
            <a href="auth.php"><button class="action-button" aria-label="User account">
              <img class="person-circle" src="./images/icons//person-circle.svg" alt="" />
            </button>
            </a>
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
      <hr class="hr">
      </header>
