<?php

/**
 * Project: students-manager
 * User: mrmad
 * Date: 10.1.2016 г.
 * Time: 0:46
 */
class UsersController extends Controller
{
    function index()
    {


    }

    function login()
    {   var_dump($_POST);
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
        }else{
            header("Location:index.php?url=users/index");
        }
    }

    static function authenticate($u, $p)
    {
        $authenticate = false;
        if ($u == 'admin' && $p == 'admin') {
            $authenticate = true;
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
}
