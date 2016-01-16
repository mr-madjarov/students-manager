<?php
/**
 * Project: students-manager
 * User: mrmad
 * Date: 14.1.2016 г.
 * Time: 1:44
 */
?>
    <a href="./index.php?url=category/add">Add category</a>

    <table border="1">
        <tr>
            <th> Name</th>
            <th> Parent</th>

        </tr>


<?php
//var_dump($categories);exit;
foreach ($categories as $key => $value) {
    extract($value["Category"]);
    echo "<tr>" .
        "<td>" . $name . "</td>
             <td>" . $parent_id . "</td>
        </tr>";


}

echo "</table>";