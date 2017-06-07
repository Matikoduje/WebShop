<?php

require_once "_config.php";

try {
    $connection = new PDO(DSN, USER_NAME, USER_PASSWORD);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $format = "Error: %s";
    echo sprintf($format, $e->getMessage());
}

//$stmt = $connection->query("SELECT adminPassword FROM admins WHERE adminId = 1");
//foreach ($stmt as $item) {
//    var_dump(password_verify("adminPZ1", $item['adminPassword']));
//}

//$hashedPassword = password_hash("admin", PASSWORD_DEFAULT);
//$stmt = $connection->query(
//    "INSERT INTO admins (adminEmail, adminLogin, adminPassword)
//              VALUES ('admin@wp.pl', 'admin', '$hashedPassword')");