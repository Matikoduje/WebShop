<?php

session_start();

if (isset($_SESSION['adminId'])) {
    echo "admin (id " . $_SESSION['adminId'] . ") został wylogowany";
    unset($_SESSION['adminId']);
    echo "<br>". "<a href='adminLoginForm.php'>Przejdź do strony logowania administratora</a>";
} else {
    echo "nikt nie jest zalogowany";
    die ("<br>". "<a href='adminLoginForm.php'>Przejdź do strony logowania administratora</a>");
}