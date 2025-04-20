<?php 
 require_once 'db.php'; 
function formatPrc($price)
{
    return number_format($price, 0, ".", " ") . ' ₸';
}

$NEW = "SELECT * FROM Products ";
$ASC = "SELECT * FROM Products ORDER BY price ASC";
$DESC = "SELECT * FROM Products ORDER BY price DESC";

 $sort = isset($_GET["sort"]) ? $_GET["sort"] :"";
$order = $_GET['sort'] ?? 'new';

switch( $order ) {
    case 'desc': 
        $sql = $DESC;
        break;
    case 'asc':
        $sql = $ASC;
        break;
    case 'new':
        $sql = $NEW;
        break;
    default:
        $sql = $NEW;
       break;

}

$stmt = $pdo ->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


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
        
        <?php include 'header.php'; ?>
        
         <form method="GET"  style="align-self: flex-end;" class="me-5">
            <label for="category"class="form-label">Сортировать : </label>
            <select  class="" id="sort" name="sort"  onchange="this.form.submit()" required>
                <option value="new" <?=$sort == 'new' ? 'selected' : '' ?>> Новинки </option>
                <option value="desc" <?=$sort == 'desc' ? 'selected' : '' ?> > По убыванию цены </option>
                <option value="asc" <?=$sort == 'asc' ? 'selected' : '' ?> > По возрастанию цены </option>
            </select>
        </form>
        <div class="filter_catalog text-center ms-4">
            <div class="filters card">
                <div class="card-header" style="background-color: none;"><b>Подбор товара</b></div>
                <form  method="POST"  class="card-body">
                    <div class="filter-category row">
                        <span><b>Ценовый диапазон</b></span>
                        <div class="d-flex">
                        <input type="number" class="form-control" id="price" name="price">
                        </div>
                    </div>
                </form>
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
        <?php include "footer.html" ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./JS/main.js"></script>
</body>

</html>