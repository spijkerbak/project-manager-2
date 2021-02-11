<?php
ini_set('display_errors', 1);

User::needLevel(Level::ADMIN);

require_once 'dao/UserDAO.php';

$userDAO = new UserDAO;
$userDAO->startList();
?>

<h2>Users</h2>
<table>
    <tr>
        <th>Name</th>
        <th>Level</th>
    </tr>
    <?php
    while ($userDAO->hasNext()) {
        $user = $userDAO->getNext();
        echo "<tr>";
        echo "<td>{$user->name}</td>";
        echo "<td>{$user->level_name}</td>";
        echo "</tr>\n";
    }
    ?>
</table>
