<?php

require "templates/adminHeader.php";



?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Zmiana nazwy kategorii</title>
</head>

<body>

    <h3>Panel Administratora / zmiana nazwy kategorii</h3>

    <form action="#" method="post">
        <div>wybierz kategorię, którą chcesz zmienić</div>
        <select name="productCategoryId">
        <?php
        $categoriesArray = ProductCategoryRepository::loadAllProductCategories($connection);
        foreach ($categoriesArray as $category) {
            $productCategoryId = $category->getProductCategoryId();
            $productCategoryName = $category->getProductCategoryName();
            echo "<option value = '" . $productCategoryId . "'>" . $productCategoryName . "</option>";
        }
        ?>
        </select>
        <div>wpisz nową nazwę kategorii</div>
        <input type="text" name="newProductCategoryName">
        <input type="hidden" name="action" value="modifyCategory" />
        <input type="submit" value="zapisz">
    </form>

    <?php

        if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "modifyCategory") {
            if (isset($_POST['productCategoryId'])) {
                $productCategoryId = $_POST['productCategoryId'];
                $newProductCategoryName = $_POST['newProductCategoryName'];
                $productCategory = ProductCategoryRepository::loadProductCategoryById($connection, $productCategoryId);
                $productCategory->setProductCategoryName($newProductCategoryName);
                $newProductCategoryName = ProductCategoryRepository::save($connection, $productCategory);
                if ($newProductCategoryName) {
                    echo sprintf("Pomyślnie zmieniono nazwę kategorii id %d na %s",
                        $newProductCategoryName->getProductCategoryId(),
                        $newProductCategoryName->getProductCategoryName());
                    echo " - strona odświeży się po 3 sekundach";
                    header("refresh: 3, url=#");
                }
            }
        }
    ?>

</body>
</html>