<?php

/**
 * Basic database connector
 *
 * HelperDbConnector
 *
 * @author Benjamin Munsch <benjamin.munsch@googlemail.com>
 */
class HelperDbConnector
{
    private $pdo = null;

    const DB_USER = 'php_guestbook';
    const DB_PASSWD = 'php_guestbook';
    const DB_NAME = 'php_guestbook';
    const DB_HOST = 'localhost';

    /**
     * prepares sql statement
     *
     * @param  string $tariffList
     * @param  array  $driverOptions
     *
     * @return PDOStatement
     */
    public static function prepare($statement, $driverOptions = [])
    {
        $dbConn = 'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME . ';charset=utf8';
        $pdo = new PDO($dbConn, self::DB_USER, self::DB_PASSWD);

        return $pdo->prepare($statement, $driverOptions);
    }
}