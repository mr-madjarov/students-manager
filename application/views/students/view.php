<?php
/**
 * Project: students-manager
 * User: mrmad
 * Date: 10.1.2016 г.
 * Time: 0:52
 */
?>
<h2><?php echo "Students Manager ". $data ?></h2>

<form action="index.php?url=students/add" method="post">
    First name: <input type="text" name="info[first_name]"><br>
    Last name:  <input type="text" name="info[last_name]"><br>
    Faculty number:  <input type="text" name="info[f_number]"><br>
    <input type="submit" value="Submit">
</form>