<?php

include_once "../autoload.php";
require_once "../src/_connection.php";
//require_once "../src/Admin.php";
//require_once "../src/AdminRepository.php";
//require_once "../src/ProductCategory.php";
//require_once "../src/ProductCategoryRepository.php";
//require_once "../src/Product.php";
//require_once "../src/ProductRepository.php";
//require_once "../src/Image.php";
//require_once "../src/ImageRepository.php";
//require_once "../src/User.php";
//require_once "../src/UserRepository.php";
//require_once "../src/ObjectInterface.php";

session_start();

if (isset($_SESSION['adminId'])) {
    echo "Zalogowany Admin: " . AdminRepository::loadAdminById($connection, $_SESSION['adminId'])->getAdminLogin();
    echo "<br>";
    echo "<a href='logout.php'>wyloguj się</a>";
    echo " lub przejdź do ";
    echo "<a href='adminPanel.php'>panelu administratora</a>";
    echo "<hr>";
} else {
    echo "nikt nie jest zalogowany";
    echo "<hr>";
}

?>