<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$userId = $_SESSION['user_id'];

// === Добавление товара в корзину ===
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $productId = (int)$_POST['add_to_cart'];

    $stmt = $pdo->prepare("SELECT * FROM shopping_cart WHERE user_id = ? AND product = ?");
    $stmt->execute([$userId, $productId]);

    if ($stmt->rowCount() > 0) {
        $pdo->prepare("UPDATE shopping_cart SET quantity = quantity + 1 WHERE user_id = ? AND product = ?")
            ->execute([$userId, $productId]);
    } else {
        $pdo->prepare("INSERT INTO shopping_cart (user_id, product, quantity) VALUES (?, ?, 1)")
            ->execute([$userId, $productId]);
    }

    header('Location: shop-cart.php');
    exit();
}

// === Удаление товара ===
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_product_id'])) {
    $productId = (int)$_POST['delete_product_id'];
    $pdo->prepare("DELETE FROM shopping_cart WHERE user_id = ? AND product = ?")
        ->execute([$userId, $productId]);

    header('Location: shop-cart.php');
    exit();
}

// === Обновление количества ===
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_quantity'])) {
    foreach ($_POST['update_quantity'] as $productId => $quantity) {
        $quantity = max(1, (int)$quantity); // минимум 1
        $pdo->prepare("UPDATE shopping_cart SET quantity = ? WHERE user_id = ? AND product = ?")
            ->execute([$quantity, $userId, $productId]);
    }

    header('Location: shop-cart.php');
    exit();
}

// === Получение данных товаров в корзине ===
$stmt = $pdo->prepare("
    SELECT shopping_cart.product, shopping_cart.quantity, products.product_name, products.price, products.product_img
    FROM shopping_cart
    JOIN products ON shopping_cart.product = products.id
    WHERE shopping_cart.user_id = ?
");
$stmt->execute([$userId]);
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
$path = "./images/"
?>

<!-- HTML -->

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
        <h1 class="fs-3 mb-5 ms-5">Ваша корзина товаров</h1>
        <hr class="cart-line">
        <div class="container-for-cart">
            <?php if ($cartItems): 
                $total = 0;
                foreach ($cartItems as $item): 
                    $itemTotal = $item['price'] * $item['quantity'];
                    $total += $itemTotal;
            ?>
                <div class="product-cart">
                    <form method="POST">
                        <input type="hidden" name="delete_product_id" value="<?= $item['product'] ?>">
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
                    <form method="POST" class="ms-5">
                        <input type="number" min="1" name="update_quantity[<?= $item['product'] ?>]" value="<?= $item['quantity'] ?>" class="input-cart" onchange="this.form.submit()">
                    </form>
                    <span class="price ms-5"><b><?= number_format($itemTotal, 0, ".", " ") ?> ₸</b></span>
                </div>
                <hr class="cart-line">
            <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Корзина пуста</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="confirm">
        <div class="confirm-main">
            <span><b>Итого: <?= number_format($total ?? 0, 0, ".", " ") ?> ₸</b></span>
        </div>
        <button class="confirm-btn">Оформить заказ</button>
    </div>
</div>

<?php include "footer.html"; ?>

<script src="./JS/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
