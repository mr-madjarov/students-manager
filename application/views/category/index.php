<?php
/**
 * Project: students-manager
 * User: mrmad
 * Date: 14.1.2016 г.
 * Time: 1:44
 */
?>
<div class="mainContent">
    <a href="./index.php?url=category/add" class="addbutt"><span class="plus">&#43;</span> category</a>
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
echo "</div>";