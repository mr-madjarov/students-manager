<?php

/**
 * Project: students-manager
 * User: mrmad
 * Date: 10.1.2016 г.
 * Time: 22:30
 */
class Activities_studentController extends Controller
{
    function add()
    {
        $model = new Activities_student();


        if (isset($_POST['info']) and $_POST['info']['student_id'] != '' and $_POST['info']['activity_id'] != '') {
            $activity = $_POST['info'];
            $student_id = $activity['student_id'];
            $activity_id = $activity['activity_id'];
            $model->student_id = $student_id;
            $model->activity_id = $activity_id;

            if ($model->save()) {
                header('Location: ' . 'index.php?url=activities_student/index');
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


}