<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог</title>
    <link rel="stylesheet" href="./style/global.css" />
    <link rel="stylesheet" href="./style/style.css" />

    <link rel="stylesheet" href="./style/media.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="frame">
        <?php require_once 'db.php'; ?>
        <?php include 'header.php'; ?>
        <?php
        $stmt = $pdo->query("SELECT * FROM products");
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        function formatPrc($price)
        {
            return number_format($price, 0, ".", " ") . ' ₸';
        }
        ?>
        <div class="filter_catalog">
        <div class="filters">

        </div>
        <div class="container d-flex justify-content-center pt-3">
        <div class="catalog-grid">

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
                            <img src="./images/icons/heart.svg" alt="" class="heart" data-hover="./images/icons/heart-fill.svg" />
                        </button>
                        <button class="add-to-cart">В корзину</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Нет товаров для отображения</p>
            <?php endif; ?>
        </div>
        </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./JS/main.js"></script>
</body>

</html>