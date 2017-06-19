<?php

include_once "../autoload.php";
require_once "../src/_connection.php";

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
