<?php
/**
 * Project: students-manager
 * User: mrmad
 * Date: 10.1.2016 г.
 * Time: 0:52
 */
?>
<h2><?php echo "Students Manager Index" ?></h2>

<a  href="./index.php?url=students/view">Add students</a>
    <table border="1">
        <tr>
            <th>First name </th>
            <th>Last Name</th>
            <th>Faculty number</th>
        </tr>



<?php
foreach($students as $key => $value){
    extract($value["Student"]);
    echo "<tr>".
            "<td>".$firstName."</td>
             <td>".$lastName."</td>
             <td>".$f_number."</td>
        </tr>";


}

echo "</table>";