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
            <li><a href="productAddPicture.php">Dodaj zdjęcie produktu do bazy</a></li>
        </ul>

    <div>Zarządzaj kategoriami produktu</div>
        <ul>
            <li><a href="categoryAddNew.php">Dodaj nową kategorię</a></li>
            <li><a href="categoryModify.php">Zmień nazwę kategorii</a></li>
        </ul>

    <div>Zarządzaj klientami</div>
        <ul>
            <li><a href="userList.php">Wyświetl listę klientów</a></li>
        </ul>

    <div>Zarządzaj zamówieniami</div>
        <ul>
            <li><a href="orderList.php">Wyświetl listę wszystkich zamówień</a></li>
        </ul>

    <div>Zarządzaj wiadomościami</div>
        <ul>
            <li><a href="messageCreate.php">Napisz wiadomość do użytkownika</a></li>
        </ul>

</body>
</html>
