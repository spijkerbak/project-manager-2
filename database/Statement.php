<?php

ini_set('display_errors', 1);

class Result {

    private $sql;
    private $stmt;

    function __construct($pdo, $sql) {
        $this->sql = $sql;
        $this->stmt = $pdo->prepare($this->sql);
    }

    function execute(array $argv = []): bool {
        if (Database::$debug) {
            echo "<br>\n";
            echo "SQL: {$this->sql}<br>\n";
            echo "Parameters: [ " . implode(', ', $argv) . " ]<br>\n";
        }
        $status = $this->stmt->execute($argv);
        if (Database::$debug) {
            echo "Status: " . ($status ? "OK" : "ERROR") . "<br>\n";
            echo "Row count:" . $this->getRowCount() . "<br>\n";
        }
        return $status;
    }

    function getRowCount(): int {
        return $this->stmt->rowCount();
    }

    function getNext($class): ?Model {
        return $this->stmt->fetchObject($class) ?: null;
    }

    function getValue(): ?Object {
        return $this->stmt->fetchColumn();
    }

}
