<?php



session_start();
include 'db.php'; 


if (!isset($_SESSION['user_id']) || !isset($_POST['product_id'])) {
    http_response_code(400);
    echo 'error';
    exit;
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];

// Проверка: товар уже в избранном?
$stmt = $pdo->prepare("SELECT 1 FROM favorites WHERE user_id = ? AND product_id = ?");
$stmt->execute([$user_id, $product_id]);

if ($stmt->fetch()) {
    // Уже есть — удаляем
    $delete = $pdo->prepare("DELETE FROM favorites WHERE user_id = ? AND product_id = ?");
    $delete->execute([$user_id, $product_id]);
    echo 'removed';
} else {
    // Нет — добавляем
    $insert = $pdo->prepare("INSERT INTO favorites (user_id, product_id) VALUES (?, ?)");
    $insert->execute([$user_id, $product_id]);
    echo 'added';
}

?>