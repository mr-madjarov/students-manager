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
        $st_activity = new Statistic();

        $students = $st_activity->query("SELECT  first_name,last_name, f_number, `group`,flow,subject,alumni,  sum(point) point  FROM activities_students
LEFT JOIN activitys   ON activities_students.activity_id = activitys.id
LEFT JOIN students   ON activities_students.student_id = students.id
GROUP BY student_id
ORDER BY point DESC
LIMIT 1");
        $student = array_shift($students);
        $result = array();

        $ime = $student['Student']['first_name'] . " " . $student['Student']['last_name'];
        $group = $student['Student']['group'];
        $flow = $student['Student']['flow'];
        $subject = $student['Student']['subject'];
        $alumni = $student['Student']['alumni'];
        $f_number = $student['Student']['f_number'];
        $pt = $student['']['point'];
        array_push($result, array('fn' => $f_number,
            'group' => $group,
            'flow' => $flow,
            'subject' => $subject,
            'alumni' => $alumni,
            'points' => array(
                $ime => $pt,
            )
        ));


        $best = max(array_column($result, 'points'));
        $names = array_keys($best);
        $points = $best[$names[0]];

        $analiz_group = $this->getStatFor('group', $group);
        $min_g = end($analiz_group);
        $min_in_group = $min_g['']['point'];
        $average_in_group = $this->getAverage($analiz_group);




        $analiz_flow = $this->getStatFor('flow', $flow);
        $min_f = end($analiz_flow);
        $min_in_flow = $min_g['']['point'];
        $average_in_flow = $this->getAverage($analiz_flow);

        $analiz_subject = $this->getStatFor('subject', $subject);
        $min_s = end($analiz_subject);
        $min_in_subject = $min_g['']['point'];
        $average_in_subject = $this->getAverage($analiz_subject);

        $analiz_alumni = $this->getStatFor('alumni', $alumni);
        $min_a = end($analiz_alumni);
        $min_in_alumni = $min_g['']['point'];
        $average_in_alumni = $this->getAverage($analiz_alumni);


        echo "<br>";
        echo "Best student is: <b> ";
        echo $names[0] . " - " . $points . " points. </b>";
        echo "<div class='statistics'>";
            echo "<div class='row'>";
                echo"Average  points for  group ".$group. " is:  " .round($average_in_group,2);
            echo "</div>";
            echo "<div class='row'>";
                 echo"Average  points for  flow ".$flow. " is:  " .round($average_in_flow,2);
            echo "</div>";
            echo "<div class='row'>";
                echo"Average  points for ".$subject. " is:  " .round($average_in_subject,2);
            echo "</div>";
            echo "<div class='row'>";
                 echo"Average  points for  class of  ".$alumni. " is:  " .round($average_in_alumni,2);
            echo "</div>";



        echo "<div class='row'>";
        echo"Min  points for  group ".$group. " is:  " .round($min_in_group,2);
        echo "</div>";
        echo "<div class='row'>";
        echo"Min  points for  flow ".$flow. " is:  " .round($min_in_flow,2);
        echo "</div>";
        echo "<div class='row'>";
        echo"Min  points for ".$subject. " is:  " .round($min_in_subject,2);
        echo "</div>";
        echo "<div class='row'>";
        echo"Min  points for  class of  ".$alumni. " is:  " .round($min_in_alumni,2);
        echo "</div>";
        echo "<div class='row'>";

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
        if(isset($id) and $id != "--Select class --"){
        $this->bestIn('alumni', $id);
        }else{
            echo "Please, select class!";
        }
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

    private function getStatFor($field, $value)
    {
        $request = new Statistic();
        return $request->query("SELECT   sum(point) point  FROM activities_students
  LEFT JOIN activitys   ON activities_students.activity_id = activitys.id
  LEFT JOIN students   ON activities_students.student_id = students.id
  where `$field` = '$value'
GROUP BY student_id
ORDER BY point DESC");
    }
    private function getAverage($array)
    {
        $i = 0;
        $sum = 0;
        foreach ($array as $item) {
            $i++;
            $sum += $item['']['point'];


        }
        return $sum / $i;
    }
}