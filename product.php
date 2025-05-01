<?php
session_start();
require_once 'db.php';

$product_id = $_GET['id'] ?? null;

if (!$product_id) {
    header("Location: catalog.php");
    exit();
}

$stmt = $pdo->prepare("SELECT p.*, c.category_name, b.brand FROM products p 
    LEFT JOIN categories c ON p.product_category = c.id
    LEFT JOIN brands b ON p.brand = b.id
    WHERE p.id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "Товар не найден.";
    exit();
}

function formatPrc($price)
{
    return number_format($price, 0, ".", " ") . ' ₸';
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($product['product_name']) ?></title>
    <link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="./style/global.css" />
  <link rel="stylesheet" href="./style/style.css" />
  <link rel="stylesheet" href="./style/media.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include 'header.php'; ?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-5 img-background">
            
            <img src="./images/<?= $product['product_img'] ?>" alt="<?= htmlspecialchars($product['product_name']) ?>" class=" product-site-img">
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-5">
            <h1><?= htmlspecialchars($product['product_name']) ?></h1>
            <p><strong>Категория:</strong> <?= htmlspecialchars($product['category_name']) ?></p>
            <p><strong>Бренд:</strong> <?= htmlspecialchars($product['brand']) ?></p>
            <p><strong>Цена:</strong> <?= formatPrc($product['price']) ?></p>
            <p><strong>Описание:</strong> <?= nl2br(htmlspecialchars($product['product_desc'])) ?></p>

            <form method="POST" action="shop-cart.php">
                <input type="hidden" name="add_to_cart" value="<?= $product['id'] ?>">
                <button type="submit" class="add-to-cart">Добавить в корзину</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.html'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="./JS/main.js"></script>
</body>
</html>
