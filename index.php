<?php
ini_set('display_errors', 1);

require_once 'model/User.php';

$title = 'Task Manager';

$currentUser = User::getCurrent();

$view = filter_input(INPUT_GET, 'view');
if (empty($view)) {
    $view = 'Home';
}
if ($currentUser->level == Level::NONE) {
    $views = [
        'Home' => 'Home',
        'ProjectList' => 'Projects',
        'TaskList' => 'Tasks',
        'Login' => 'Login',
    ];
}
else if ($currentUser->level == Level::USER) {
    $views = [
        'Home' => 'Home',
        'ProjectList' => 'Projects',
        'TaskList' => 'Tasks',
        'Logout' => 'Logout',
    ];
}
else if ($currentUser->level == Level::ADMIN) {
    $views = [
        'Home' => 'Home',
        'TaskList' => 'Tasks',
        'ProjectList' => 'Projects',
        'Logout' => 'Logout',
        'UserList' => 'Users',
        'Database' => 'Database',
    ];
}

?><!doctype html>
<html lang='nl'>
    <head>
        <title><?= $title ?></title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style/style.css">
    </head>
    <body>
        <header>
            <h1><?= $title ?></h1>
        </header>
        <nav>
            <?php foreach ($views as $name => $title) { ?>
                <a href="?view=<?= $name ?>"><?= $title ?></a>
            <?php } ?>
        </nav>
        <main>
            <?php
            require "view/{$view}.php";
            ?>
        </main>
        <footer>
            <p>&copy; Frans Spijkerman 2020 - Sources staan op <a target="github" href="https://github.com/spijkerbak/project-manager-2">Github</a></p>
        </footer>
    </body>
</html>