<?php
ini_set('display_errors', 1);

require_once 'database/Database.php';

abstract class DAO {

    private $class;
    private $db;
    private $stmt;
    private $object;

    function __construct($class) {
        $this->class = $class;
        $this->db = new Database();
    }

    protected function startListSql($sql, $args = []): void {
        $this->stmt = $this->db->prepare($sql);
        $this->stmt->execute($args);
        $this->object = $this->stmt->getNext($this->class);
    }

    protected function getObjectSql($sql, $args = []): ?Model {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($args);
        return $stmt->getNext($this->class);
    }

    function hasNext(): bool {
        return $this->object !== null;
    }

    function getNext(): Model {
        $result = $this->object;
        $this->object = $this->stmt->getNext($this->class);
        return $result;
    }

}
