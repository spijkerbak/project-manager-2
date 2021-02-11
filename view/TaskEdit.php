<?php
ini_set('display_errors', 1);

require_once 'model/Task.php';
require_once 'dao/TaskDAO.php';

$key = filter_input(INPUT_GET, 'key');
$taskDAO = new TaskDAO;

Database::$debug = false;

$task = $taskDAO->get($key);
?>

<h2>Task</h2>
<form>
    <label>Title<input name="title" value="<?= $task->title?>"></label>   
    <label>Text<input name="description" value="<?= $task->description?>"></label>   
    <label>Employee<input name="content" value="<?= $task->employee?>"></label>   
</form>

