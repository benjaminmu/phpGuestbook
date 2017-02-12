<?php

class HelperDbConnector
{
    private $pdo = null;
    private $dbUser = '';
    private $dbPasswd = '';
    private $dbName = '';
    private $dbHost = '';

    public function __construct()
    {
        $this->dbUser = 'php_guestbook';
        $this->dbPasswd = 'php_guestbook';
        $this->dbName = 'php_guestbook';
        $this->dbHost = 'localhost';

        $dbConn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName . ';charset=utf8';
        $this->pdo = new PDO($dbConn, $this->dbUser, $this->dbPasswd);
    }

    public function prepare($statement, $driverOptions = array())
    {
        return $this->pdo->prepare($statement, $driverOptions);
    }
}