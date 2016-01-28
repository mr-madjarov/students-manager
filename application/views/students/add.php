<?php
/**
 * Project: students-manager
 * User: mrmad
 * Date: 10.1.2016 г.
 * Time: 0:52
 */
?>
<br>
<div class="mainContent">
<form action="index.php?url=students/add" method="post">
    <span class="form-inp">First name:</span> <input type="text" name="student[first_name]"><br>
    <span class="form-inp">Last name:</span>  <input type="text" name="student[last_name]"><br>
    <span class="form-inp">Faculty number:</span>  <input type="text" name="student[f_number]"><br>
    <span class="form-inp">Subject:</span>  <input type="text" name="student[subject]"><br>
    <span class="form-inp">Group:</span>  <input type="text" name="student[group]"><br>
    <span class="form-inp">Flow:</span>  <input type="text" name="student[flow]"><br>
    <span class="form-inp">Class of:</span>  <input type="text" name="student[alumni]"><br>
    <input type="submit" value="Submit">
</form>
</div>