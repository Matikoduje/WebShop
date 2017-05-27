<?php

require "templates/adminHeader.php";

?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Dodawanie produktu</title>
</head>

<body>

<h3>Panel Administratora / dodawanie produktu</h3>

<form action="#" method="post">
    <div>Dodaj nowy produkt:</div>
    <div>nazwa:</div>
    <div><input name="productName" type="text" value="nazwa przedmiotu"></div>
    <div>cena:</div>
    <div><input name="productPrice" type="number" step="0.01" value="0.00"></div>
    <div>opis:</div>
    <div><textarea name="productDescription" type="text" rows="3" cols="80">opis produktu: max 255 znaków</textarea></div>
    <div>kategoria:</div>
    <div>
        <select name="productCategory">
            <?php
            $categoriesArray = ProductCategoryRepository::loadAllProductCategories($connection);
            foreach ($categoriesArray as $category) {
                $id = $category->getProductCategoryId();
                $cat = $category->getProductCategoryName();
                echo "<option value = '" . $id . "'>" . $cat . "</option>";
            }
            ?>
        </select>
    </div>
    <input type="hidden" name="action" value="createNewProduct" />
    <input type="submit" value="zapisz nowy produkt">
    <hr>
</form>

<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if ($_POST['action'] == "createNewProduct") {
        if (isset($_POST['productName']) &&
            isset($_POST['productPrice']) &&
            isset($_POST['productDescription']) &&
            isset($_POST['productCategory']) &&
            $_POST['productName'] != "" &&
            $_POST['productPrice'] > 0 &&
            $_POST['productDescription'] != "" &&
            $_POST['productCategory']) {

            $product = new Product();
            $product->setProductName($_POST['productName']);
            $product->setProductPrice($_POST['productPrice']);
            $product->setProductDescription($_POST['productDescription']);
            $product->setProductCategory($_POST['productCategory']);

            $newProduct = ProductRepository::save($connection, $product);
            echo "Utworzyłeś nowy produkt: " .$newProduct->getProductName() .
                " (id = " . $newProduct->getProductId() . ")";
        } else {
            die("wypełnij poprawnie wszystkie pola");
        }
    }
}

?>

</body>
</html>








