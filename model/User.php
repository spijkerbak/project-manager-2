<?php

ini_set('display_errors', 1);

session_start();

require_once 'framework/Model.php';
require_once 'dao/UserDAO.php';

class Level {

    const NONE = 0; // not logged in
    const USER = 1;
    const ADMIN = 2;

    static $names = [
        null => '',
        0 => '',
        1 => 'USER',
        2 => 'ADMIN'
    ];

}

class User extends Model {

    private static $current;

    function setDefaultValues(): void {
        $this->id = '';
        $this->name = '';
        $this->level = Level::NONE;
        $this->salt = '';
        $this->password_hash = '';
    }

    function __construct() {
        parent::__construct();
        if (!isset($this->level)) {
            $this->level = Level::NONE;
        }
        $this->level_name = Level::$names[$this->level];
    }

    static function getCurrent(): User {
        if (self::$current === null) {
            if (isset($_SESSION['current_user'])) {
                $userDAO = new UserDAO();
                $userid = $_SESSION['current_user'];
                self::$current = $userDAO->getObject($userid);
            } else {
                self::$current = new User();
                self::$current->setDefaultValues();
            }
        }
        return self::$current;
    }

    function setPassword(string $password) {
        $this->salt = md5(rand());
        $this->password_hash = md5($this->salt . $password);
    }

    private function checkPassword(string $password) {
        return md5($this->salt . $password) === $this->password_hash;
    }

    function login(string $password): bool {
        $ok = $this->checkPassword($password);
        if ($ok) {
            self::$current = $this;
            $_SESSION['current_user'] = $this->id;
        } else {
            $user = new User();
            $user->setDefaultValues();
            self::$current = $user; // empty user with no rights
            unset($_SESSION['current_user']);
        }
        return $ok;
    }

    function hasLevel(int $level) {
        return $this->level >= $level;
    }

    static function needLevel(int $level) {
        if (!self::$current->hasLevel($level)) {
            header('location: ?view=Home');
            exit;
        }
    }

}
