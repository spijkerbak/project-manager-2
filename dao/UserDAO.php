<?php
ini_set('display_errors', 1);

require_once 'framework/DAO.php';
require_once 'model/User.php';

class UserDAO extends DAO {
    
    function __construct() {
        parent::__construct('User');
    }
    
    function getObject(string $id) {
        return $this->getObjectSql("SELECT * FROM `TM2_User` WHERE `userId` = ?", [$id]);
    }

    function getByName(string $key) {
        return $this->getObjectSql("SELECT * FROM `TM2_User` WHERE `name` = ?", [$key]);
    }

    function startList(array $args = []) : void {
        $this->startListSql("SELECT * FROM `TM2_User` ORDER BY `name`");
    }
    
}