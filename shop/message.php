<?php
require 'templates/header.php';
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}
?>

<?php
require 'templates/footer.php';
