<?php

require_once 'config.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($conn->connect_errno) {
    die('Can\'t connect to database: ' . $conn->connect_error);
}

$conn->query("SET NAMES 'uft8'");
