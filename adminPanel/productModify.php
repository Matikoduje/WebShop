<?php

require "templates/adminHeader.php";

?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Modyfikowanie produktu</title>
</head>

<body>

<h3>Panel Administratora / modyfikowanie produktu</h3>

<form action="#" method="post">
    <div>Wybierz produkt do aktualizacji:</div>
    <select name="productId">
        <?php
            $productsArray = ProductRepository::loadAllProducts($connection);
            foreach ($productsArray as $product) {
                $id = $product->getProductId();
                $name = $product->getProductName();
                $price = $product->getProductPrice();
                $description = $product->getProductDescription();
                echo "<option value = '" . $id . "'>" . $name . " cena: " . $price . " opis: " . $description . "</option>";
            }
        ?>
    </select>
    <div>Wybierz pole do aktualizacji</div>
    <select name="fieldToChange">
        <option value="productName">nazwa produktu</option>
        <option value="productPrice">cena produktu</option>
        <option value="productDescription">opis produktu</option>
    </select>
    <div>Wpisz nową wartość</div>
    <input name="newValue">
    <input type="hidden" name="action" value="modifyProduct" />
    <input type="submit" value="zapisz">
</form>

<?php

if ($_SERVER['REQUEST_METHOD'] === "POST" && $_POST['action'] == "modifyProduct") {
    if (isset($_POST['productId']) &&
        isset($_POST['fieldToChange']) &&
        isset($_POST['newValue'])
    ) {
        if ($_POST['fieldToChange'] == "productName" && is_string($_POST['newValue'])) {
            $product = ProductRepository::loadProductById($connection, $_POST['productId']);
            $product->setProductName($_POST['newValue']);
            $newProduct = ProductRepository::save($connection, $product);
            if ($newProduct) {
                echo "pomyślnie zmofdyfikowano produkt - strona odświeży się po 3 sekundach";
                header("refresh: 3, url=#");
            }
        } elseif ($_POST['fieldToChange'] == "productPrice" && is_numeric($_POST['newValue'])) {
            $product = ProductRepository::loadProductById($connection, $_POST['productId']);
            $product->setProductPrice($_POST['newValue']);
            $newProduct = ProductRepository::save($connection, $product);
            if ($newProduct) {
                echo "pomyślnie zmofdyfikowano produkt - strona odświeży się po 3 sekundach";
                header("refresh: 3, url=#");
            }
        } elseif ($_POST['fieldToChange'] == "productDescription" && is_string($_POST['newValue'])) {
            $product = ProductRepository::loadProductById($connection, $_POST['productId']);
            $product->setProductDescription($_POST['newValue']);
            $newProduct = ProductRepository::save($connection, $product);
            if ($newProduct) {
                echo "pomyślnie zmofdyfikowano produkt - strona odświeży się po 3 sekundach";
                header("refresh: 3, url=#");
            }
        }
        else {
            echo "nowa wartość nie jest prawidłowa";
        }
    }
}

?>


<div>
    <a href="adminPanel.php">Przejdź do głównej strony panelu administratora</a>
</div>

</body>
</html>