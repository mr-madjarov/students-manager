<?php
/**
 * Project: students-manager
 * User: mrmad
 * Date: 17.1.2016 г.
 * Time: 1:29
 */
//var_dump($student);
//var_dump($info);
?>

<table border="1">
        <tr>
            <th>First name </th>
            <th>Last Name</th>
            <th>Points</th>
        </tr>



<?php
$sum = 0;
foreach ($info as $item => $pt) {
    extract($pt['Activity']);
    $sum = $sum + $point;
}

    extract($student["Student"]);
    echo "<tr>".
        "<td>".$first_name."</td>
             <td>".$last_name."</td>
             <td>  $sum  </td>
        </tr>";




echo "</table>";