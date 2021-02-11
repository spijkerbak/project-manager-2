<?php

ini_set('display_errors', 1);

// set include path to work from any directory level
set_include_path('./' . PATH_SEPARATOR . '../');

abstract class Controller {

    function getPost($name, $default = null) {
        $value = filter_input(INPUT_POST, $name);
        if ($value === null) {
            $value = $default;
        }
        return $value;
    }

    abstract function run();
}
