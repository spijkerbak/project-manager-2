<?php
ini_set('display_errors', 1);

require_once 'framework/DAO.php';
require_once 'model/Task.php';

class TaskDAO extends DAO {

    private static $join = "SELECT"
            . " `TM2_Task`.*, `TM2_Project`.`title` AS `project`"
            . " FROM `TM2_Task`"
            . " LEFT JOIN `TM2_Project`"
            . " ON `TM2_Task`.`projectId` = `TM2_Project`.`projectId`";
    
    function __construct() {
        parent::__construct('Task');
    }
    
    function startList() : void {
        $sql = self::$join;
        if(!empty($args) && !(empty($args[0]))) {
            $sql .= " WHERE `TM2_Task`.`projectID` = ?";
        }
        $this->startListSql($sql . " ORDER BY `title`");
    }

    function startListForProject($projectId) : void {
        $sql = self::$join;
        $sql .= " WHERE `TM2_Task`.`projectID` = ?";
        $this->startListSql($sql . " ORDER BY `title`", [$projectId]);
    }

    function getObject(string $id) {
        return $this->getObjectSql(self::$join . " WHERE `TM2_Task`.`taskId` = ?", [$id]);
    }

}