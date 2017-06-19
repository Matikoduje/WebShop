<?php

require_once "_config.php";

try {
    $connection = new PDO(DSN, USER_NAME, USER_PASSWORD);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $format = "Error: %s";
    echo sprintf($format, $e->getMessage());
}
