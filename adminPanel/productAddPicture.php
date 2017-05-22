<?php

require "templates/adminHeader.php";

?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Dodawanie zdjęcia produktu</title>
</head>

<body>

    <h3>Panel Administratora / dodawanie zdjęcia produktu</h3>

    <form method="post" action="#" enctype="multipart/form-data">
        <input type="file" name="imageFile">
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
        <input type="hidden" name="action" value="saveImage" />
        <button type="submit">Zapisz zdjęcie produktu</button>
        </p>
        <hr>
    </form>

    <?php

        if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == 'saveImage') {
            if (($_FILES['imageFile']['error'] == 0) &&
                ($_FILES['imageFile']['type'] == 'image/jpeg') &&
                isset($_POST['productId'])) {

                $productId = $_POST['productId'];
                $fileName = $_FILES['imageFile']['name'];
                $path = '../images/' . $productId . '/';
                if (!file_exists($path)) {
                    mkdir($path);
                }
                $path .= $fileName;
                if (!file_exists($path)) {
                    $result = move_uploaded_file($_FILES['imageFile']['tmp_name'], $path);
                } else {
                    die("zdjęcie o podanej nazwie pliku jest już zapisane <br>
                         <a href=\"adminPanel.php\">Przejdź do głównej strony panelu administratora</a>");
                }
                if ($result == true) {
                    $image = new Image();
                    $image->setProductId($_POST['productId']);
                    $image->setImageLink($path);
                    $result = ImageRepository::save($connection, $image);
                    if ($result) {
                        echo "Pomyślnie załączono zdjęcie do produktu o id: " . $productId . " pod ścieżką: " . $path;
                    }
                }
            } else {
                die ('nie załączono zdjęcia dla produktu <br>
                      <a href="adminPanel.php">Przejdź do głównej strony panelu administratora</a>');
            }
        }

    ?>

</body>
</html>


