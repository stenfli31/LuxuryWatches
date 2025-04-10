<?php

session_start();
include 'db.php'; 
if (!isset($_SESSION['user_id'])) {
    header('Location: auth.php');
    exit();
}
// Получить все избранные товары
$path = "./images/";
$stmt = $pdo->prepare("
    SELECT p.* FROM products p
    JOIN favorites f ON p.id = f.product_id
    WHERE f.user_id = ?
");
$stmt->execute([$_SESSION['user_id']]);
$favorites = $stmt->fetchAll();

if($_SERVER["REQUEST_METHOD"]=="POST"){
$favID = $_POST['product_id_fav'];
$favID = $pdo->prepare("DELETE FROM favorites WHERE user_id = ? AND product_id = ?");
$favID->execute([$_SESSION['user_id'], $favID]);
header('Location: favourites.php');
exit();
}
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
                        
                        <button type="submit" class="btn p-0 border-0 bg-transparent" name="product_id_fav" value="<?= $item['id'] ?>">
                            <img src="./images/icons/delete.svg" alt="Удалить" class="delete ms-3 me-3">
                        </button>
                    </form>
                    <div class="img-container-cart">
                        <img src="<?=$path . $item['product_img']?>" alt="<?= htmlspecialchars($item['product_name']) ?>" class="cart-img">
                    </div>
                    <div class="product-attributes-fav">
                        <span><b><?= htmlspecialchars($item['product_name']) ?></b></span>
                        <span class="price-cart"><?= number_format($item['price'], 0, ".", " ") ?> ₸</span>
                    </div>
                    <form method="POST" action="shop-cart.php" style="width: 150px;" >
                                    <button type="submit" name="add_to_cart" value="<?= $item['id'] ?>" class="add-to-cart">В корзину</button>
                                </form>
                    
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