<?php

/**
 * Project: students-manager
 * User: mrmad
 * Date: 18.1.2016 г.
 * Time: 18:54
 */
class StatisticController extends Controller
{
    function  index(){


    }
    function bestNow(){
        $this->doNotRenderHeader = 1;
        $st_activity = new Activities_student();

       $students =  $st_activity->query("SELECT  first_name,last_name, f_number,  sum(point) point  FROM activities_students
LEFT JOIN activitys   ON activities_students.activity_id = activitys.id
LEFT JOIN students   ON activities_students.student_id = students.id
GROUP BY student_id");

        $result = array();
        foreach($students as $key => $student){
            $st =  $student['Student']['first_name'] ." " .$student['Student']['last_name'];
            $pt =  $student['']['point'];
            array_push($result,array($st => $pt));
        }
        $best = max($result);
        $key = array_keys( $best );
        $points = $best[$key[0]];

        echo  $key[0]. " : ". $points. " points.";
        die();
    }

    function bestLastHour(){

    }
    function bestLastDay(){

    }
    function bestLastWeek(){

    }
    function bestLastMonth(){

    }
    function bestInGroup(){

    }
    function bestInFlow(){

    }
    function bestAlumni(){

    }
}