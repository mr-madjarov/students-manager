<?php
/**
 * Project: students-manager
 * User: mrmad
 * Date: 14.1.2016 г.
 * Time: 1:44
 */
?>
<div class="mainContent">
    <a href="./index.php?url=activities_student/add" class="addbutt">Add student activity</a>

    <table border="1">
        <tr>
            <th> Student_id</th>
            <th> Activity_id</th>
            <th> Added at</th>

        </tr>

<?php

if (isset($info)) {
    foreach ($info as $key => $value) {
        extract($value["Activities_student"]);
        echo "<tr>" .
            "<td>" . $student_id . "</td>
             <td>" . $activity_id . "</td>
             <td>" . $created_at . "</td>
        </tr>";
    }
}
echo "</table>";
echo "</div>";