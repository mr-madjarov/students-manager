<?php
/**
 * Project: students-manager
 * User: mrmad
 * Date: 10.1.2016 г.
 * Time: 0:52
 */
?>
<div class="mainContent">
<h2><?php echo "Students Manager Index" ?></h2>

<a  href="./index.php?url=students/add" class="addbutt"><span class="plus">&#43;</span> student</a>
    <table border="1">
        <tr>
            <th>First name </th>
            <th>Last Name</th>
            <th>Faculty number</th>
            <th>Subject</th>
            <th>Group</th>
            <th>Flow</th>
            <th>Class of</th>
        </tr>



<?php

foreach($students as $key => $value){
    extract($value["Student"]);
    echo "<tr>".
            "<td class=\"firstname\"> <a href='index.php?url=students/view/$id'>".$first_name."</a></td>
             <td>".$last_name."</td>
             <td>".$f_number."</td>
             <td>".$subject."</td>
             <td>".$group."</td>
             <td>".$flow."</td>
             <td>".$alumni."</td>
        </tr>";


}

echo "</table>";
echo "</div>";