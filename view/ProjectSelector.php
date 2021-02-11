<?php
ini_set('display_errors', 1);

require_once 'model/Project.php';
require_once 'dao/ProjectDAO.php';

$projectId = filter_input(INPUT_POST, 'projectId');

$projectDAO = new ProjectDAO;
$projectDAO->startList();
?>

<form method="post">
    <label>Project :
        <select name="projectId" onchange="submit()">
            <option value=""></option>
            <?php
            while ($projectDAO->hasNext()) {
                $project = $projectDAO->getNext();
                $selected = $project->projectId == $projectId ? 'selected' : '';
                echo "<option {$selected} value='{$project->projectId}'>{$project->title}</option>\n";
            }
            ?>
        </select>
    </label>
</form>