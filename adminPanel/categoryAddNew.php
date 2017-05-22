<?php

require "templates/adminHeader.php";

?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Dodawanie nowej kategorii</title>
</head>

<body>

    <h3>Panel Administratora / dodawanie nowej kategorii</h3>

    <form action="#" method="post">
        <div>wpisz nową kategorię</div><input name="productCategoryName" type="text">
        <input type="hidden" name="action" value="createNewCategory" />
        <input type="submit" value="zapisz">
    </form>

    <?php

    if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "createNewCategory") {
        if (isset($_POST['productCategoryName'])) {
            $category = new ProductCategory();
            $category->setProductCategoryName($_POST['productCategoryName']);
            $newCategory = ProductCategoryRepository::save($connection, $category);
            if ($newCategory) {
                echo "Utworzyłeś nową kategorię: " . $newCategory->getProductCategoryName() .
                    " (id = " . $newCategory->getProductCategoryId() . " )";
            }
        }
    }

    ?>

</body>
</html>
