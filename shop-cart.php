<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: auth.php');
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
    <link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="./style/global.css">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/media.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include "header.php"; ?>

<div class="d-flex justify-content-around display-column">
    <div class="shop-cart ms-md-5 mt-5 mb-md-5">
        <h1 class="fs-md-3 fs-5 mb-5 ms-md-5">Ваша корзина товаров</h1>
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
                            <img src="./images/icons/delete.svg" alt="Удалить" class="delete ms-md-3 me-md-3 me-1">
                        </button>
                    </form>
                    <div class="img-container-cart">
                        <img src="<?=$path . $item['product_img']?>" alt="<?= htmlspecialchars($item['product_name']) ?>" class="cart-img">
                    </div>
                    <div class="product-attributes">
                        <span><b><?= htmlspecialchars($item['product_name']) ?></b></span>
                        <span class="price-cart"><?= number_format($item['price'], 0, ".", " ") ?> ₸</span>
                    </div>
                    <form method="POST" class="input-cart-form">
                        <input type="number" min="1" name="update_quantity[<?= $item['product'] ?>]" value="<?= $item['quantity'] ?>" class="input-cart" onchange="this.form.submit()">
                    </form>
                    <span class="price ms-md-5"><b><?= number_format($itemTotal, 0, ".", " ") ?> ₸</b></span>
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
        
        <a href="#order"><button class="confirm-btn">Оформить заказ</button></a>
    </div>
</div>
<div class="container my-5" id="order">
    <h2 class="mb-4">Оформление заказа</h2>
    <form method="POST" action="order.php">
        <!-- Телефон -->
        <div class="mb-3">
            <label for="phone" class="form-label">Телефон</label>
            <input type="tel" name="phone" class="form-control" id="phone" placeholder="+7 (___) ___-__-__" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="example@mail.com" required>
        </div>

        <!-- Адрес доставки -->
        <div class="mb-3">
            <label for="address" class="form-label">Адрес доставки</label>
            <input type="text" name="address" class="form-control" id="address" required>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="city" class="form-label">Город</label>
                <input type="text" name="city" class="form-control" id="city" required>
            </div>
            <div class="col-md-4">
                <label for="region" class="form-label">Регион</label>
                <input type="text" name="region" class="form-control" id="region">
            </div>
            <div class="col-md-2">
                <label for="zip" class="form-label">Индекс</label>
                <input type="text" name="zip" class="form-control" id="zip" required>
            </div>
        </div>

        <!-- Способ оплаты -->
        <div class="mb-3">
            <label class="form-label">Способ оплаты</label>
            <select name="payment_method" class="form-select" required>
                <option selected disabled value="">Выберите...</option>
                <option value="card">Карта</option>
                <option value="cash">Наличные при получении</option>
                <option value="transfer">Перевод на счёт</option>
            </select>
        </div>

        <!-- Комментарий -->
        <div class="mb-3">
            <label for="comment" class="form-label">Комментарий к заказу</label>
            <textarea name="comment" class="form-control" id="comment" rows="3"></textarea>
        </div>

        <!-- Кнопка -->
        <button type="submit" class="btn btn-primary">Оформить заказ</button>
    </form>
</div>

<?php include "footer.html"; ?>

<script src="./JS/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.8/dist/inputmask.min.js"></script>
<script>
      // Маска для телефона
      Inputmask("+7 (999) 999-99-99").mask("#phone");
    </script>
</body>
</html>
