<?php

require "templates/adminHeader.php";

?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Zmiana ilości produktu</title>
</head>

<body>

<h3>Panel Administratora / zmiana stanu magazynowego produktu</h3>

<form action="#" method="post">
    <div>Zmień stan magazynowy produktu: (+/-)</div>
    <select name="productId">
        <?php
            $productsArray = ProductRepository::loadAllProducts($connection);
            foreach ($productsArray as $product) {
                $id = $product->getProductId();
                $name = $product->getProductName();
                $price = $product->getProductPrice();
                $quantity = $product->getProductQuantity();
                echo "<option value = '" . $id . "'>" . $name . " cena: " . $price . " stan magazynowy: " . $quantity . "</option>";
            }
        ?>
    </select>
    <div>wpisz zmianę stanu magazynowego: </div><input name="productQuantityChange" type="number" step="1" value="0">
    <input type="hidden" name="action" value="changeQuantity" />
    <input type="submit" value="zapisz">
</form><hr>

<?php

    if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "changeQuantity") {
        if (isset($_POST['productId']) && isset($_POST['productQuantityChange'])) {
            $productId = $_POST['productId'];
            $productQuantityChange = $_POST['productQuantityChange'];
            $result = ProductRepository::changeInventory($connection, $productId, $productQuantityChange);
            if ($result == false) {
                die("nie można zmienić stanu magazynowego");
            } else {
                echo "pomyślnie zmieniono stan magazynowy - strona odświeży sie po 3 sekundach";
                header("refresh:3; url=#");
            }
        } else {
            die("wypełnij poprawnie wszystkie pola");
        }
    }

?>


<div>
    <a href="adminPanel.php">Przejdź do głównej strony panelu administratora</a>
</div>

</body>
</html>


