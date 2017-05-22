<?php

require_once '../src/_connection.php';
require_once '../src/Admin.php';
require_once '../src/AdminRepository.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['adminEmail']) &&
        isset($_POST['adminLogin']) &&
        isset($_POST['adminPassword'])) {

        $adminEmail = $_POST['adminEmail'];
        $adminLogin = $_POST['adminLogin'];
        $adminPassword = $_POST['adminPassword'];
        $admin = AdminRepository::loadAdminByEmail($connection, $adminEmail);

        if ($admin == null) {
            echo("nie istnieje admin o takim adresie email");
            die ("<br>". "<a href='adminLoginForm.php'>Przejdź do strony logowania administratora</a>");
        }

        if (password_verify($adminPassword, $admin->getAdminPassword()) && $adminLogin == $admin->getAdminLogin()) {
            $_SESSION['adminId'] = $admin->getAdminId();
            echo "zalogowałeś się poprawnie jako: " . $admin->getAdminLogin();
            echo "<br>". "<a href='adminPanel.php'>Przejdź do panelu administratora</a>";
        } else {
            echo "błędny login lub hasło";
            die ("<br>". "<a href='adminLoginForm.php'>Przejdź do strony logowania administratora</a>");
        }
    }
}