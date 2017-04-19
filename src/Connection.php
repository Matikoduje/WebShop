<?php

class Connection implements Iconnect
{
    private static $server = IConnect::DB_HOST;
    private static $currentDB = IConnect::DB_NAME;
    private static $user = IConnect::DB_USER;
    private static $pass = IConnect::DB_PASSWORD;
    private static $conn;

    public function doConnect()
    {
        try {
            self::$conn = new PDO("mysql:host=" . self::$server . ";dbname=" . self::$currentDB, self::$user, self::$pass);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$conn->query("SET NAMES 'utf8'");
            return self::$conn;
        }
        catch (PDOException $e) {
            echo "Błąd połączenia z bazą danych" . $e->getMessage();
        }
    }
}