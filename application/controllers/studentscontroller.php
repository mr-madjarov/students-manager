<?php

/**
 * Project: students-manager
 * User: mrmad
 * Date: 10.1.2016 г.
 * Time: 0:46
 */
use Student as Students;
class StudentsController extends Controller
{

    function view()
    {
        $this->set('data', "view - action");
    }

    function add()
    {
        $model = new Student();

        // var_dump($_POST);exit;
        if (isset($_POST['info']) and $_POST['info']['first_name'] != ''
                                  and $_POST['info']['last_name'] != ''
                                  and $_POST['info']['f_number'] != ''
        ) {
            $student = $_POST['info'];
            $first_name = $student['first_name'];
            $last_name = $student['last_name'];
            $f_number = $student['f_number'];

            $info = $model->query("insert into students (firstName, lastName, f_number) values (\"$first_name\", \"$last_name\",\"$f_number\")");
            $this->set("title", "Success!");
            header('Location: '.'index.php?url=students/index');
            die();
        }else {
            $this->set("title", "Empty field! Add failed!");

        }

    }

    function index()
    {

        $this->set('students',$this->loadModel()->selectAll());
    }

    public function loadModel()
    {
        $model = new $this->_model;

        return $model;
    }
}
