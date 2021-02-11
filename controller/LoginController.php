<?php
ini_set('display_errors', 1);

require_once '../framework/Controller.php';
require_once 'dao/UserDAO.php';

class LoginController extends Controller {

    private $userDAO;

    function __construct() {
        $this->userDAO = new UserDao();
    }

    function run() {
        $username = $this->getPost('username', '');
        $password = $this->getPost('password', '');
        $user = $this->userDAO->getByName($username);
        if ($user === null) {
            $user = new User();
            $user->setDefaultValues();
        }
        if (!$user->login($password)) {
            header('location: ../?view=Login');
            exit;
        }
        header('location: ../?view=Home');
        exit;
    }

}

$controller = new LoginController();
$controller->run();

