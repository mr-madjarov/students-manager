<?php

/**
 * Project: students-manager
 * User: mrmad
 * Date: 10.1.2016 г.
 * Time: 0:46
 */
class StudentsController extends Controller
{
    function add()
    {
        $model = new Student();

        // var_dump($_POST);exit;
        if (isset($_POST['student']) and $_POST['student']['first_name'] != ''
            and $_POST['student']['last_name'] != ''
            and $_POST['student']['f_number'] != ''
        ) {
            $student = $_POST['student'];
            $first_name = $student['first_name'];
            $last_name = $student['last_name'];
            $f_number = $student['f_number'];

            $model->first_name = $first_name;
            $model->last_name = $last_name;
            $model->f_number = $f_number;
            if ($model->save()) {
                header('Location: ' . 'index.php?url=students/index');
                die();
            }
        } else {
            $this->set("title", "Empty field! Add failed!");

        }

    }

    function index()
    {

        $this->set('students', $this->loadModel()->selectAll());
    }

    public function loadModel()
    {
        $model = new $this->_model;

        return $model;
    }
}
