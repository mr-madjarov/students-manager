<?php
/**
 * Project: students-manager
 * User: mrmad
 * Date: 14.1.2016 г.
 * Time: 1:44
 */
?>
    <a href="./index.php?url=categories_student/add">Add category</a>

    <table border="1">
        <tr>
            <th> Student_id</th>
            <th> Category_id</th>

        </tr>


<?php

if (isset($info)) {
    foreach ($info as $key => $value) {
        extract($value["Categories_student"]);
        echo "<tr>" .
            "<td>" . $student_id . "</td>
             <td>" . $category_id . "</td>
        </tr>";
    }
}
echo "</table>";