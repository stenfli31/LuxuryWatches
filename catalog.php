<!DOCTYPE html>
<?php session_start(); ?>
<?php
require_once 'db.php';



function formatPrc($price)
{
    return number_format($price, 0, ".", " ") . ' ₸';
}



$sql = "SELECT * FROM products WHERE 1=1";

$stmt = $pdo->query("SELECT * FROM categories");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $pdo->query("SELECT * FROM brands");
$brands = $stmt->fetchAll(PDO::FETCH_ASSOC);

$selectedCategories = $_GET['category'] ?? [];
$selectedBrands = $_GET['brand'] ?? [];
$priceFrom = $_GET['priceFrom'] ?? '';
$priceTo = $_GET['priceTo'] ?? '';
$search = $_GET['search'] ?? '';



$stmt = $pdo->query("SELECT MAX(price) as max_price, MIN(price) as min_price FROM products");
$priceRange = $stmt->fetch(PDO::FETCH_ASSOC);

if (!empty($selectedCategories) && is_array($selectedCategories)) {
    $escaped = array_map('intval', $selectedCategories);
    $inCat = implode(",", $escaped);
    $sql .= " AND product_category IN ($inCat)";
}


if (!empty($selectedBrands) && is_array($selectedBrands)) {
    $escaped = array_map('intval', $selectedBrands);
    $inBrand = implode(",", $escaped);
    $sql .= " AND brand IN ($inBrand)";
}

if (!empty($priceFrom) or !empty($priceTo)) {
    if (empty($priceFrom)) {
        $priceFrom = $priceRange['min_price'];
    }
    if (empty($priceTo)) {
        $priceTo = $priceRange['max_price'];
    }
    $sql .= " AND price BETWEEN $priceFrom AND $priceTo ";
}

if (!empty($search)) {
    $search = "'%" . $search . "%'";
    $sql .= " AND product_name LIKE $search ";
}
$NEW = " ORDER BY id DESC ";
$ASC = " ORDER BY price ASC";
$DESC = " ORDER BY price DESC";




$order = $_GET['sort'] ?? 'new';


switch ($order) {
    case 'desc':
        $sql .= $DESC;
        break;
    case 'asc':
        $sql .= $ASC;
        break;
    case 'new':
        $sql .= $NEW;
        break;
}

$queryParams = $_GET;
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Получаем все товары в избранном для текущего пользователя
if (isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("SELECT product_id FROM favorites WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $favIds = $stmt->fetchAll(PDO::FETCH_COLUMN);
}

?>



<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог</title>
    <link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="./style/global.css" />
    <link rel="stylesheet" href="./style/style.css" />

    <link rel="stylesheet" href="./style/media.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="frame">

        <?php include 'header.php'; ?>

        <form method="GET" style="align-self: flex-end;" class="me-5 mt-5">
            <label for="sort" class="form-label">Сортировать : </label>
            <select class="" id="sort" name="sort" onchange="onSortChange(this.value)">
                <option value="new" <?= ($order === 'new') ? 'selected' : '' ?>> Новинки </option>
                <option value="desc" <?= ($order == 'desc') ? 'selected' : '' ?>> По убыванию цены </option>
                <option value="asc" <?= ($order == 'asc') ? 'selected' : '' ?>> По возрастанию цены </option>
            </select>
        </form>
        <div class="filter_catalog text-center ms-4 ">
            <div class="filters card">
                <div class="card-header" style="background-color: none;"><b>Подбор товара</b></div>
                <form method="GET" class="card-body" id="filterForm">
                    <div class="filter-category row mb-4">
                        <span class="mb-2"><b>Ценовый диапазон</b></span>
                        <div class="d-flex justify-content-around" id="priceRangeInp">
                            <div class="d-flex flex-column align-items-center">
                                <? $priceFromValue = !empty($priceFrom) ? "value='$priceFrom'" : '' ?>
                                <input type="number" min="<?= $priceRange['min_price'] ?>" max="<?= $priceRange['max_price'] ?>"
                                    class="form-control " id="priceFrom" name="priceFrom" <?= $priceFromValue ?>
                                    placeholder="<?= $priceRange['min_price'] ?> " oninput="setMask(event)">
                                <label for="priceFrom">От:</label>
                            </div>
                            <div class="d-flex flex-column align-items-center">
                                <? $priceToValue = !empty($priceTo) ? "value='$priceTo'" : '' ?>
                                <input type="number" min="<?= $priceRange['min_price'] ?>" max="<?= $priceRange['max_price'] ?>"
                                    class="form-control" id="priceTo" name="priceTo" <?= $priceToValue ?>
                                    placeholder="<?= $priceRange['max_price'] ?>">
                                <label for="priceTo">До:</label>
                            </div>
                        </div>
                    </div>
                    <div class="filter-category mb-4">

                        <span class="mb-2"><b>Пол:</b></span>
                        <div class="filter-cards">
                            <?php foreach ($categories as $cat): ?>
                                <? $checkedCats = in_array($cat['id'], $selectedCategories) ? 'checked' : ' '; ?>
                                <input type="checkbox" class="tag-check" id="<?= $cat['category_name'] ?>" name="category[]" value="<?= $cat['id'] ?>" <?= $checkedCats ?>>
                                <label class="tag-label" for="<?= $cat['category_name'] ?>"><?= $cat['category_name'] ?></label>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="filter-category mb-5">
                        <span class="mb-2"><b>Бренд:</b></span>
                        <div class="filter-cards">
                            <?php foreach ($brands as $brand): ?>
                                <? $checkedBrand = in_array($brand['id'], $selectedBrands) ? 'checked' : ' '; ?>
                                <input type="checkbox" class="tag-check" id="<?= $brand['brand'] ?>" name="brand[]" value="<?= $brand['id'] ?>" <?= $checkedBrand ?>>
                                <label class="tag-label" for="<?= $brand['brand'] ?>"><?= $brand['brand'] ?></label>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary rounded-1" style="background-color: #7a5c25; border-color: #7a5c25;" onclick="resetCheckedCheckboxes()">Сбросить</button>
                        <button type="submit" class="btn btn-primary rounded-1 ms-3" style="background-color: #CBA135; border-color: #CBA135;">Применить</button>
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
                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <button class="favorite-button" aria-label="Add to favorites" data-product-id="<?= $product['id'] ?>" name="add-to-fav" value="<?= $product['id'] ?>" type="button">
                                        <img src="<?= in_array($product['id'], $favIds) ? './images/icons/heart-fill.svg' : './images/icons/heart.svg' ?>" alt="В избранное" class="heart" data-hover="./images/icons/heart-fill.svg" />
                                    </button>
                                <?php else: ?>

                                    <a href="auth.php">
                                        <button class="favorite-button" aria-label="Add to favorites" data-product-id="<?= $product['id'] ?>" name="add-to-fav" value="<?= $product['id'] ?>" type="button">
                                            <img src="./images/icons/heart.svg" alt="В избранное" class="heart" data-hover="./images/icons/heart.svg" />
                                        </button>
                                    </a>

                                <?php endif ?>

                                <form method="POST" action="shop-cart.php" style="width: 100%;" >
                                    <button type="submit" name="add_to_cart" value="<?= $product['id'] ?>" class="add-to-cart">В корзину</button>
                                </form>

                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center" style="width: 100%;">Нет товаров для отображения</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php include "footer.html" ?>
    </div>
    <script src="./JS/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>