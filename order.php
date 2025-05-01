<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: auth.php');
    exit();
}

$userId = $_SESSION['user_id'];

// Получаем данные из формы
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$city = $_POST['city'];
$region = $_POST['region'];
$zip = $_POST['zip'];
$payment_method = $_POST['payment_method'];
$comment = $_POST['comment'];

// 1. Получаем товары из корзины
$stmt = $pdo->prepare("
    SELECT shopping_cart.product, shopping_cart.quantity, products.product_name, products.price 
    FROM shopping_cart
    JOIN products ON shopping_cart.product = products.id
    WHERE shopping_cart.user_id = ?
");
$stmt->execute([$userId]);
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$cartItems) {
    die("Корзина пуста.");
}

// 2. Считаем общую сумму заказа
$total_amount = 0;
foreach ($cartItems as $item) {
    $total_amount += $item['price'] * $item['quantity'];
}

// 3. Создаём запись о заказе в таблице `orders`
$stmt = $pdo->prepare("
    INSERT INTO orders (user_id, address, created_at, total_amount, payment_method, status, phone, email, city, region, zip, comment)
    VALUES (?, ?, NOW(), ?, ?, 'В обработке', ?, ?, ?, ?, ?, ?)
");
$stmt->execute([$userId, $address, $total_amount, $payment_method, $phone, $email, $city, $region, $zip, $comment]);

$order_id = $pdo->lastInsertId(); // Получаем ID нового заказа

// 4. Переносим товары в таблицу `order_items`
$stmt = $pdo->prepare("
    INSERT INTO order_items (order_id, product_id, quantity, price)
    VALUES (?, ?, ?, ?)
");
foreach ($cartItems as $item) {
    $stmt->execute([$order_id, $item['product'], $item['quantity'], $item['price']]);
}

// 5. Очищаем корзину пользователя
$stmt = $pdo->prepare("DELETE FROM shopping_cart WHERE user_id = ?");
$stmt->execute([$userId]);

// Перенаправление на страницу с подтверждением
header('Location: order-success.php');
exit();
?>