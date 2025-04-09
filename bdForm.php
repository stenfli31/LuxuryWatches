<?php
 require_once 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$product_name = $_POST['name'];
$price = $_POST['price'];
$desc = $_POST['desc'];
$category = $_POST['category'];
$img = $_POST['img'];

$sql = "INSERT INTO Products(product_name, price, product_desc, product_category, product_img)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $pdo->prepare($sql);
$stmt->execute([$product_name, $price, $desc, $category, $img]);
$message= "Данные успешно добавлены!";
}

$categories=[];
$stmt = $pdo->query("SELECT id, category_name FROM categories");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body d-flex justify-content-center>
    

<div class="container mt-5">
    <h2 class="mb-4">Добавление товара</h2>
    <?php if (!empty($message)): ?>
        <div class="alert alert-succes"></div>
    <?php endif; ?>
<form method="POST" class="col-4">
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
        <div class="mb-3  row">
            <label for="img"class="form-label">Фото</label>
            <input type="file" class="form-control" id="img" name="img" required>
        </div>
        <button type="submit" class="btn btn-primary col-4">Добавить</button>
</form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>