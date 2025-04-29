<?php

session_start();
include 'db.php'; 
// Получить все избранные товары
$path = "./images/";
$stmt = $pdo->prepare("
    SELECT p.* FROM products p
    JOIN favorites f ON p.id = f.product_id
    WHERE f.user_id = ?
");
$stmt->execute([$_SESSION['user_id']]);
$favorites = $stmt->fetchAll();
?>



<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Корзина</title>
    <link rel="stylesheet" href="./style/global.css">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/media.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include "header.php"; ?>

<div class="d-flex justify-content-around">
    <div class="shop-cart ms-5 mt-5 mb-5">
        <h1 class="fs-3 mb-5 ms-5">Избранное</h1>
        <hr class="cart-line">
        <div class="container-for-cart">
       <? if ($favorites): 
       foreach ($favorites as $item): ?>
                <div class="product-cart">
                    <form method="POST">
                        <input type="hidden" name="delete_product_id_fav" value="<?= $item['id'] ?>">
                        <button type="submit" class="btn p-0 border-0 bg-transparent">
                            <img src="./images/icons/delete.svg" alt="Удалить" class="delete ms-3 me-3">
                        </button>
                    </form>
                    <div class="img-container-cart">
                        <img src="<?=$path . $item['product_img']?>" alt="<?= htmlspecialchars($item['product_name']) ?>" class="cart-img">
                    </div>
                    <div class="product-attributes">
                        <span><b><?= htmlspecialchars($item['product_name']) ?></b></span>
                        <span class="price-cart"><?= number_format($item['price'], 0, ".", " ") ?> ₸</span>
                    </div>
                    
                </div>
                <hr class="cart-line">
            <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Нет избранных товаров</p>
            <?php endif; ?>
        </div>
    </div>

</div>

<?php include "footer.html"; ?>

<script src="./JS/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>