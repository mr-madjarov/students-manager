<?php
/**
 * Project: students-manager
 * User: mrmad
 * Date: 10.1.2016 г.
 * Time: 0:52
 */
?>
<br>
<form action="index.php?url=students/add" method="post">
    First name: <input type="text" name="student[first_name]"><br>
    Last name:  <input type="text" name="student[last_name]"><br>
    Faculty number:  <input type="text" name="student[f_number]"><br>
    Subject:  <input type="text" name="student[subject]"><br>
    Group:  <input type="text" name="student[group]"><br>
    Flow:  <input type="text" name="student[flow]"><br>
    Class of:  <input type="text" name="student[alumni]"><br>
    <input type="submit" value="Submit">
</form>