<?php

/**
 * Project: students-manager
 * User: mrmad
 * Date: 10.1.2016 г.
 * Time: 0:46
 */
class UsersController extends Controller
{
    function beforeAction()
    {
        if (isset($_POST['password']) and !isset($_POST['login'])) {

            $_POST['password'] = $this->hash($_POST['password']);
            var_dump($_POST['password']);
        }

    }

    function index()
    {


    }

    function view()
    {
        $model = new User();
        $list = $model->selectAll();

        $this->set('users', $list);
    }

    function add()
    {
        if (isset($_POST['username']) and isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            var_dump($password);
            $model = new User();
            $model->setUsername($username);
            $model->setPassword($password);
            if ($model->save()) {
                header('Location: ' . 'index.php?url=users/view');
                die();
            }
        } else {
            header("Location:index.php?url=users/adddialog/err");
        }

    }

    function login()
    {
        if (isset($_POST['username']) and isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($this->authenticate($username, $password)) {
                session_start();

                $user = new User();
                $user->User($username);

                $_SESSION['user'] = $user;


                header("Location:index.php");
                exit;
            } else {
                header("Location:index.php?url=users/index/err");
            }
        } else {
            header("Location:index.php?url=users/index");
        }
    }

    static function authenticate($u, $p)
    {
        $authenticate = false;
        $model = new User();
        $user = $model->query("SELECT password FROM users WHERE username = '$u'");
        if ($user) {
            $password = $user[0]['User']['password'];

            if (password_verify($p, $password)) {
                $authenticate = true;
            }
        }
        return $authenticate;
    }

    function logout()
    {
        session_start();
        session_destroy();
        header("Location:index.php?url=users/index");
    }


    public function loadModel()
    {
        $model = new $this->_model;

        return $model;
    }

    private function hash($p)
    {
        return password_hash($p, PASSWORD_DEFAULT);
    }

    function afterAction()
    {

    }
}
