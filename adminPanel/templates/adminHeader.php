<?php

require_once "../src/_connection.php";
require_once "../src/Admin.php";
require_once "../src/AdminRepository.php";
require_once "../src/ProductCategory.php";
require_once "../src/ProductCategoryRepository.php";
require_once "../src/Product.php";
require_once "../src/ProductRepository.php";
require_once "../src/Image.php";
require_once "../src/ImageRepository.php";

session_start();

if (isset($_SESSION['adminId'])) {
    echo "Zalogowany Admin: " . AdminRepository::loadAdminById($connection, $_SESSION['adminId'])->getAdminLogin();
    echo "<br><a href='logout.php'>wyloguj</a>";
    echo "<hr>";
} else {
    echo "nikt nie jest zalogowany";
    echo "<hr>";
    //die ("<br>". "<a href='adminLoginForm.php'>Przejdź do strony logowania administratora</a>");
}

?>