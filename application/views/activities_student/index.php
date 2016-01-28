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
                <th> STUDENT</th>
                <th> NUMBER</th>
                <th> ACTIVITY</th>
                <th> POINT</th>
                <th> ADDED AT</th>
            </tr>
<?php

if (isset($students)) {
    foreach ($students as $key => $value) {
        echo "<tr>" .
                "<td>" . $value['student_id'] . "</td>
                 <td>" . $value['f_number'] . "</td>
                 <td>" . $value['activity_id'] . "</td>
                 <td>" . $value['point'] . "</td>
                 <td>" . $value['created_at'] . "</td>
            </tr>";
    }
}
echo "</table>";
echo "</div>";