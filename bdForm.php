<?php
 require_once 'db.php';
 
 session_start();
 
 // Проверяем, есть ли в сессии информация о статусе пользователя
 if (!isset($_SESSION['user_status']) || $_SESSION['user_status'] != 1)
 {
     // Если статус не админ, перенаправляем на страницу входа
     header('Location: index.php');
     exit;  // Прерываем выполнение скрипта
 }
 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {

$product_name = $_POST['name'];
$price = $_POST['price'];
$desc = $_POST['desc'];
$brand = $_POST['brand'];
$category = $_POST['category'];
$img = $_POST['img'];

$sql = "INSERT INTO Products(product_name, price, product_desc, brand,product_category, product_img)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $pdo->prepare($sql);
$stmt->execute([$product_name, $price, $desc, $brand, $category, $img]);
$message= "Данные успешно добавлены!";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_product'])) {

    $product_id = $_POST['product_id'];
    
    $sql = "DELETE FROM products WHERE id = ?";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$product_id]);
    $message= "Данные успешно удалены!";
    }

$categories=[];
$stmt = $pdo->query("SELECT id, category_name FROM categories");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

$brands =[];
$stmt = $pdo->query("SELECT id, brand FROM brands");
$brands = $stmt->fetchAll(PDO::FETCH_ASSOC);

$products =[];
$stmt = $pdo->query("SELECT id, product_name FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<a href="index.php" class="btn btn-primary admin mt-1 ms-2">Назад</a> 
<? echo $_SESSION['username'] ;?>
<?php if (!empty($message)): ?>
    <?php if($message=== "Данные успешно добавлены!"): ?>
        <div id="message" class="alert alert-success"><?=$message ?></div>
    <?php else: ?>
        <div id="message" class="alert alert-danger"><?=$message ?></div>
        <?php endif ?>
    <?php endif; ?>
    
<div class="d-flex">
    <div class="container mt-5 card col-5">
        <h2 class="mb-4 card-title">Добавление товара</h2>
    
    <form method="POST" class="col-10 ms-5 card-body">
            <div class="mb-3 row">
                <label for="name"class="form-label">Наименование товара</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3 row">
                <label for="price"class="form-label">Цена</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3 row" >
                <label for="desc"class="form-label">Описание товара</label>
                <input type="text" class="form-control" id="desc" name="desc" required>
            </div>
            <div class="mb-3 row">
                <label for="category"class="form-label">Категория</label>
                <select type="text" class="form-control" id="category" name="category" required>
                    <option value=""> Выберите категорию </option>
                    <?php foreach ($categories as $cat ): ?>
                        <option value="<?=$cat['id']?>"><?=htmlspecialchars($cat['category_name'])?></option>
                        <?php endforeach ?>
                </select>
            </div>
            <div class="mb-3 row">
                <label for="category"class="form-label">Бренд</label>
                <select type="text" class="form-control" id="brand" name="brand" required>
                    <option value=""> Выберите бренд </option>
                    <?php foreach ($brands as $brand ): ?>
                        <option value="<?=$brand['id']?>"><?=htmlspecialchars($brand['brand'])?></option>
                        <?php endforeach ?>
                </select>
            </div>
            <div class="mb-3  row">
                <label for="img"class="form-label">Фото</label>
                <input type="file" class="form-control" id="img" name="img" required>
            </div>
            <button type="submit" class="btn btn-primary col-4" name="add_product">Добавить</button>
    </form>
    </div>
    
    <div class="container mt-5 card mb-5 col-5">
        <h2 class="mb-4 card-title">Удаление товара</h2>
    
    <form method="POST" class="col-10 ms-5 card-body">
    
            <div class="mb-3 row">
                <label for="product_id" class="form-label">Наименование</label>
                <select type="text" class="form-control" id="product_id" name="product_id" required>
                    <option value=""> Выберите товар </option>
                    <?php foreach ($products as $product ): ?>
                        <option value="<?=$product['id']?>"><?=htmlspecialchars($product['product_name'])?></option>
                        <?php endforeach ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary col-4" name="delete_product">Удалить</button>
    </form>
    </div>
</div>
<script>
    // Проверяем, есть ли элемент с id "message"
    window.onload = function() {
        var messageElement = document.getElementById('message');
        
        if (messageElement) {
            // Через 3 секунды скрываем сообщение
            setTimeout(function() {
                messageElement.style.display = 'none';
            }, 3000); // 3000 миллисекунд = 3 секунды
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>