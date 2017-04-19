<?php

abstract class AbstractDatabaseTest extends \PHPUnit\DbUnit\TestCase
{
    protected $pdo;

    protected function getConnection()
    {
        $this->pdo = new \PDO(
            $GLOBALS['DB_DSN'],
            $GLOBALS['DB_USER'],
            $GLOBALS['DB_PASSWD']
        );
        return $this->createDefaultDBConnection($this->pdo, $GLOBALS['DB_NAME']);
    }

    protected function getDataSet()
    {
        return $this->createMySQLXMLDataSet('file.xml');
    }
}