<?php

require "templates/adminHeader.php";

?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
</head>
<body>

    <h3>Panel Administratora</h3>

    <div>Zarządzaj produktami</div>
        <ul>
            <li><a href="productAddNew.php">Dodaj nowy produkt</a></li>
            <li><a href="productModify.php">Zmodyfikuj istniejący produkt</a></li>
            <li><a href="productChangeQuantity.php">Zmień ilość produktu</a></li>
            <li><a href="productChangeCategory.php">Zmień kategorię produktu</a></li>

        </ul>

    <div>Zarządzaj kategoriami produktu</div>
        <ul>
            <li><a href="categoryAddNew.php">Dodaj nową kategorię</a></li>
            <li><a href="categoryModify.php">Zmień nazwę kategorii</a></li>
        </ul>

    <div>Zarządzaj klientami</div>
        <ul>

        </ul>

    <div>Zarządzaj zamówieniami</div>
        <ul>

        </ul>

    <div>Zarządzaj wiadomościami</div>
        <ul>

        </ul>

</body>
</html>
