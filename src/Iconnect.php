<?php

interface Iconnect
{
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASSWORD = 'coderslab';
    const DB_NAME = 'WebShop_DB';

    public function doConnect();
}