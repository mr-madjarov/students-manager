<?php
/**
 * Project: students-manager
 * User: mrmad
 * Date: 14.1.2016 г.
 * Time: 1:45
 */

function listStudents($getStudents)
{
    foreach ($getStudents as $key => $value) {
        echo '<option value=' . $value['id'] . "> " . $value['first_name'] . " " . $value['last_name'] . "</option>";
    }
}
function listActivities($data)
{
    foreach ($data as $key => $value) {
        echo '<option value=' . $value['id'] . "> " . $value['name']  . "</option>";
    }
}
?>
<br>
<form action="index.php?url=activities_student/add" method="post">
    Student: <?php echo "<select name='info[student_id]'>
                            <option>--Select student -- </option>";
                            listStudents($getStudents);
                    echo "</select>"; ?><br>
    Activity: <?php echo "<select name='info[activity_id]'>
                            <option>--Select activity -- </option>";
                            listActivities($getActivities);
                            echo "</select>"; ?><br>
    <input type="submit" value="Submit">
</form>