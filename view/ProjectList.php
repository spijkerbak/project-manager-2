<?php
ini_set('display_errors', 1);

//Database::$debug = true;

require_once 'model/Project.php';
require_once 'dao/ProjectDAO.php';

$projectDAO = new ProjectDAO;
$projectDAO->startList();

?>

<h2>Projects</h2>
<table>
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Manager</th>
    </tr>
    <?php
    while ($projectDAO->hasNext()) {
        $project = $projectDAO->getNext();
        ?>
        <tr onclick="">
            <td><?= $project->title ?></td>
            <td><?= $project->description ?></td>
            <td><?= $project->manager ?></td>
        </tr>
        <?php
    }
    ?>
</table>
