<?php

/**
 * Project: students-manager
 * User: mrmad
 * Date: 18.1.2016 г.
 * Time: 18:54
 */
class StatisticController extends Controller
{
    function index()
    {
        $model = new Statistic();
        $selectAlumni = '';
        $alumni = $model->query("SELECT DISTINCT alumni FROM  students");
        foreach ($alumni as $key => $value) {
            foreach ($value as $k => $v)
                $selectAlumni .= '<option value=' . $v['alumni'] . "> " . $v['alumni'] . "</option>";
        }
        $this->set('selectAlumni', $selectAlumni);
    }

    function bestNow()
    {
        $this->doNotRenderHeader = 1;
        $st_activity = new Activities_student();

        $students = $st_activity->query("SELECT  first_name,last_name, f_number, `group`,  sum(point) point  FROM activities_students
LEFT JOIN activitys   ON activities_students.activity_id = activitys.id
LEFT JOIN students   ON activities_students.student_id = students.id
GROUP BY student_id
ORDER BY point DESC");

        $result = array();
        foreach ($students as $key => $student) {
            $st = $student['Student']['first_name'] . " " . $student['Student']['last_name'];
            $pt = $student['']['point'];
            array_push($result, array($st => $pt));
        }
        $best = max($result);
        $key = array_keys($best);
        $points = $best[$key[0]];
        echo "<br>";
        echo $key[0] . " - " . $points . " points.";
    }

    function bestLastHour()
    {
        $this->doNotRenderHeader = 1;
        $this->bestForLast("HOUR");
    }

    function bestLastDay()
    {
        $this->doNotRenderHeader = 1;
        $this->bestForLast("DAY");
    }

    function bestLastWeek()
    {
        $this->doNotRenderHeader = 1;
        $this->bestForLast("WEEK");
    }

    function bestLastMonth()
    {
        $this->doNotRenderHeader = 1;
        $this->bestForLast("MONTH");
    }

    function bestInGroup($id)
    {
        $this->doNotRenderHeader = 1;
        $this->bestIn('group', $id);
    }

    function bestInFlow($id)
    {
        $this->doNotRenderHeader = 1;
        $this->bestIn('flow', $id);
    }

    function bestInAlumni($id)
    {
        $this->doNotRenderHeader = 1;
        $this->bestIn('alumni', $id);
    }

    /**
     * @param $string
     */
    private function bestForLast($string)
    {
        $st_activity = new Activities_student();

        $students = $st_activity->query("SELECT  first_name,last_name, f_number,  sum(point) point  FROM activities_students
  LEFT JOIN activitys   ON activities_students.activity_id = activitys.id
  LEFT JOIN students   ON activities_students.student_id = students.id
WHERE created_at > DATE_SUB(NOW(), INTERVAL 1 " . "$string" . ")
GROUP BY student_id
ORDER BY point DESC");
        $result = array();
        $i = 0;
        foreach ($students as $key => $student) {
            $st = $student['Student']['first_name'] . " " . $student['Student']['last_name'];
            $pt = $student['']['point'];
            array_push($result, array($st => $pt));
        }
        if (!empty($result)) {
            foreach ($result as $name => $point) {
                foreach ($point as $key => $value) {
                    echo "<br>";
                    echo ++$i . ". " . $key . " " . $value;
                    echo "<br>";
                }

            }
        } else {
            echo "<br>No active students last " . strtolower($string) . "!";
        }
    }

    /**
     * @param $section
     * @param $num
     * @param string $string
     */
    private function bestIn($section, $num, $string = "YEAR")
    {
        $st_activity = new Activities_student();

        $students = $st_activity->query("SELECT  first_name,last_name, f_number,  sum(point) point  FROM activities_students
  LEFT JOIN activitys   ON activities_students.activity_id = activitys.id
  LEFT JOIN students   ON activities_students.student_id = students.id
WHERE created_at > DATE_SUB(NOW(), INTERVAL 1 " . "$string" . ") AND  `$section` = $num
GROUP BY student_id
ORDER BY point DESC");
        $result = array();
        $i = 0;
        foreach ($students as $key => $student) {
            $st = $student['Student']['first_name'] . " " . $student['Student']['last_name'];
            $pt = $student['']['point'];
            array_push($result, array($st => $pt));
        }
        if (!empty($result)) {
            foreach ($result as $name => $point) {
                foreach ($point as $key => $value) {
                    echo "<br>";
                    echo ++$i . ". " . $key . " - " . $value . " points.";
                    echo "<br>";
                }

            }
        } else {
            echo "<br>No active students!";
        }
    }

    private function studentInfo($section, $flow, $alumni, $subject)
    {
        $model = new Student();

        $info = $model->query("SELECT DISTINCT `$section` FROM students
WHERE flow = $flow AND  alumni = $alumni AND students.subject = '" . $subject . "'");

    }
}