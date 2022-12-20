<?php
require_once 'framework/View.php';
require_once 'model/Task.php';
require_once 'dao/TaskDAO.php';
require_once 'ProjectSelector.php';
?>

<?php

class TaskList extends View {

    function show() {
        $taskDAO = new TaskDAO;

        $ps = new ProjectSelector();
        $projectId = $ps->getProjectId();

        if (empty($projectId)) {
            $taskDAO->startList();
            $projectSelected = false;
        } else {
            $taskDAO->startListForProject($projectId);
            $projectSelected = true;
        }
        ?>
        <h2>Tasks</h2>
        <nav>
            <a href="?view=TaskEdit&action=insert">Add task</a>
        </nav>

        <table>
            <tr>
                <th></th>
                <th></th>
                <?php if (!$projectSelected) { ?>
                    <th>Project</th>
                <?php } ?>
                <th>Number</th>
                <th>Task</th>
                <th>Worker</th>
                <th>Status</th>
            </tr>
            <?php
            while ($taskDAO->hasNext()) {
                $task = $taskDAO->getNext();
                ?>
                <tr>
                    <td><a href="?view=TaskEdit&projectId=<?= $task->getProjectId() ?>&taskNumber=<?= $task->getTaskNumber() ?>">edit</a></td>
                    <td><a onclick="return confirm('Zeker weten?')" 
                           href="?controller=TaskController&action=delete&projectId=<?= $task->getProjectId() ?>&taskNumber=<?= $task->getTaskNumber() ?>">delete</a></td>
                        <?php if (!$projectSelected) { ?>
                        <td><?= $task->getProject() ?></td>
                    <?php } ?>
                    <td><?= $task->getTaskNumber() ?></td>
                    <td><?= $task->getTitle() ?></td>
                    <td><?= $task->getWorker() ?></td>
                    <td><?= $task->getStatus() ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }

}

new TaskList;
