<?php

/**
 * Project: students-manager
 * User: mrmad
 * Date: 10.1.2016 г.
 * Time: 22:30
 */
class ActivityController extends Controller
{
    function beforeAction()
    {

    }
    function add()
    {
        $model = new Activity();


        if (isset($_POST['activity']) and $_POST['activity']['name'] != '' and $_POST['activity']['point'] != '') {
            $activity = $_POST['activity'];
            $name = $activity['name'];
            $point = $activity['point'];
            $model->name = $name;
            $model->point = $point;

            if ($model->save()) {
                header('Location: ' . 'index.php?url=activity/index');
                die();
            }
        } else {
            $this->set("title", "Error! Empty field!");

        }

    }

    function index()
    {
        $this->set('activities', $this->loadModel()->selectAll());
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