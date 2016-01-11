<?php

/**
 * Project: students-manager
 * User: mrmad
 * Date: 10.1.2016 г.
 * Time: 0:46
 */


class StudentsController extends Controller
{
    function view()
    {
        $this->set('data', "view - action");
    }
    function add() {
        $model = new Student();

       // var_dump($_POST);exit;
        $student = $_POST['info'];
        $first_name = $student['first_name'];
        $last_name = $student['last_name'];
        $f_number = $student['f_number'];
        $this->set('title','Success - add student');
        //$model->connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

        $info = $model->query("insert into students (firstName, lastName, f_number) values (\"$first_name\", \"$last_name\",\"$f_number\")");

    }
    function index(){


    }
}
