<?php
ini_set('display_errors', 1);

require_once 'model/Task.php';
require_once 'dao/TaskDAO.php';

$taskDAO = new TaskDAO;
?>
<h2>Tasks</h2>

<?php
include 'ProjectSelector.php';

if(empty($projectId)) {
    $taskDAO->startList($projectId);
} else {
    $taskDAO->startListForProject($projectId);
}
?>
<table>
    <tr>
        <th>Project</th>
        <th>Task</th>
        <th>Employee</th>
    </tr>
    <?php
    while ($taskDAO->hasNext()) {
        $task = $taskDAO->getNext();
        echo "<tr>";
        echo "<td>{$task->project}</td>";
        echo "<td>{$task->title}</td>";
        echo "<td>{$task->employee}</td>";
        echo "</tr>\n";
    }
    ?>
</table>
