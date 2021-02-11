<?php

ini_set('display_errors', 1);

require_once 'framework/DAO.php';
require_once 'model/Project.php';

class ProjectDAO extends DAO {

    function __construct() {
        parent::__construct('Project');
    }

    function startList(): void {
        $this->startListSql('SELECT * FROM `TM2_Project`'
                . ' ORDER BY `TM2_Project`.`projectId`');
    }

    function getObject(string $projectID) {
        $this->getObjectSql('SELECT * FROM `TM2_Project`'
                . ' WHERE `TM2_Project`.`projectId` = ?'
                . ' ORDER BY `TM2_Project`.`projectId`', [$projectID]);
    }

}
