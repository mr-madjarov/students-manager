<?php
/**
 * Project: students-manager
 * User: mrmad
 * Date: 14.1.2016 г.
 * Time: 1:47
 */
?>
<div class="mainContent">
<div class="butt">
    <a href="./index.php?url=activity/add" class="addbutt">Add activity</a>
</div>
    <table border="1">
        <tr>
            <th> Name</th>
            <th> Points</th>

        </tr>


<?php
//var_dump($categories);exit;
foreach ($activities as $key => $value) {
    extract($value["Activity"]);
    echo "<tr>" .
            "<td>" . $name . "</td>
             <td>" . $point . "</td>
          </tr>";
}
echo "</table>";
echo "</div>";