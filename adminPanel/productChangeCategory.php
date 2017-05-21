<?php

require "templates/adminHeader.php";

?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Zmiana kategorii produktu</title>
</head>
<body>

    <form action="#" method="post">
        <div>Wybierz produkt i zmień jego kategorię:</div>
        <select name="productId">
            <?php
                $productsArray = ProductRepository::loadAllProducts($connection);
                foreach ($productsArray as $product) {
                    $productId = $product->getProductId();
                    $productName = $product->getProductName();
                    $categoryName = ProductCategoryRepository::loadProductCategoryById($connection, $product->getProductCategory())->getProductCategoryName();
                    echo "<option value = '" . $productId . "'>" . $productName . " | kategoria: " . $categoryName . "</option>";
                }
            ?>
        </select>
        <select name="categoryId">
            <?php
                $categoriesArray = ProductCategoryRepository::loadAllProductCategories($connection);
                foreach ($categoriesArray as $category) {
                    $categoryId = $category->getProductCategoryId();
                    $categoryName = $category->getProductCategoryName();
                    echo "<option value = '" . $categoryId . "'>" . $categoryName . "</option>";
                }
            ?>
        </select>
            <input type="hidden" name="action" value="changeCategoryOfProduct" />
            <input type="submit" value="zapisz">
        </p><hr>
    </form>

    <?php

        if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "changeCategoryOfProduct") {
            if (isset($_POST['productId']) && isset($_POST['categoryId'])) {
                $product = ProductRepository::loadProductById($connection, $_POST['productId']);
                $product->setProductCategory($_POST['categoryId']);
                $modifiedProduct = ProductRepository::save($connection, $product);
                if (!$modifiedProduct) {
                    die("nie udało się zmienić kategorii produktu");
                } else {
                    echo "pomyślnie zmieniono kategorię produktu - strona odświeży sie po 3 sekundach";
                    header("refresh:3; url=#");
                }
            }
        }
    ?>


    <div>
        <a href="adminPanel.php">Przejdź do głównej strony panelu administratora</a>
    </div>

</body>
</html>