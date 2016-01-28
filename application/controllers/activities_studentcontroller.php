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
        try{
        $model = new Activities_student();

        $students = new Student();
        $listStudents = $students->selectAll();
        $getStudents = array_column($listStudents,'Student');

        $activity = new Activity();
        $listActivities = $activity->selectAll();
        $getActivities = array_column($listActivities, 'Activity');


        $this->set('getStudents', $getStudents );
        $this->set('getActivities', $getActivities );

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
        }catch(Exception $e){

        }

    }

    function index()
    {
        $students = new Student();
        $activities = new Activity();
        $result = array();
        $info =  $this->loadModel()->selectAll();
        foreach ($info  as $key => $item) {
            extract($item["Activities_student"]);

            $st =   $students->select($student_id);
            $st2 = array_shift($st);

            $ac = $activities->select($activity_id);
            $ac2 = array_shift($ac);

            $arr = array(
                'student_id' => $st2['first_name']." ".$st2['last_name'],
                'f_number' => $st2['f_number'],
                'activity_id' => $ac2['name'],
                'point' => $ac2['point'],
                'created_at' => $created_at,
            );
            array_push($result, $arr);
        }

        $this->set('students',$result);
    }

    public function loadModel()
    {
        $model = new $this->_model;

        return $model;
    }


}