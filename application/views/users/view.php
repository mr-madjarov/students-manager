<?php
/**
 * Project: students-manager
 * User: mrmad
 * Date: 30.1.2016 г.
 * Time: 21:46
 */
if (!isset($_SESSION['user'])) {
    header("Location:index.php?url=users/index");
}
?>
    <div class="mainContent">
    <h2><?php echo "Users" ?></h2>

    <table border="1">
        <tr>
            <th>Username</th>
        </tr>

        <a href="./index.php?url=users/adddialog" class="addbutt"><span class="plus">&#43;</span> user</a>
<?php

foreach ($users as $key => $value) {
    extract($value["User"]);
    echo "<tr>
             <td>" . $username . "</td>
        </tr>";


}

echo "</table>";
echo "</div>";