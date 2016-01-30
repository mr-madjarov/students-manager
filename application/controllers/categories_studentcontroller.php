<?php

/**
 * Project: students-manager
 * User: mrmad
 * Date: 10.1.2016 г.
 * Time: 22:30
 */
class Categories_studentController extends Controller
{
    function beforeAction()
    {

    }
    function add()
    {
        $model = new Categories_student();


        if (isset($_POST['info']) and $_POST['info']['student_id'] != '' and $_POST['info']['category_id'] != '') {
            $activity = $_POST['info'];
            $student_id = $activity['student_id'];
            $category_id = $activity['category_id'];
            $model->student_id = $student_id;
            $model->category_id = $category_id;

            if ($model->save()) {
                header('Location: ' . 'index.php?url=categories_student/index');
                die();
            }
        } else {
            $this->set("title", "Error! Empty field!");

        }

    }

    function index()
    {
        $this->set('info', $this->loadModel()->selectAll());
    }

    public function loadModel()
    {
        $model = new $this->_model;

        return $model;
    }
    function afterAction()
    {

    }


}