<?php
ini_set('display_errors', 1);

require_once 'secret.php';
require_once 'Statement.php';

/*
 * Database
 * Hides interface like PDO, msqli, MSSQL, ODBC, ...
 */

class Database {

    private $pdo;
    static $debug = false;

    function __construct() {
        $this->connect(Secret::DB_HOST, Secret::DB_NAME, Secret::DB_USERNAME, Secret::DB_PASSWORD);
    }

    private function connect($host, $dbname, $user, $pass): void {
        try {
            $dsn = "mysql:dbname=$dbname;host=$host;charset=utf8"; // no hyphen in utf8
            $this->pdo = new PDO($dsn, $user, $pass, null);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            die('Database connection failed: ' . $ex->getMessage());
        }
    }

    function prepare($sql): Result {
        return new Result($this->pdo, $sql);
    }

}
