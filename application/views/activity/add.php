<?php
/**
 * Project: students-manager
 * User: mrmad
 * Date: 14.1.2016 г.
 * Time: 1:47
 */
if (!isset($_SESSION['user'])) {
    header("Location:index.php?url=users/index");
}
?>
<br>
<div class="mainContent">
    <form action="index.php?url=activity/add" method="post">
        <span class="form-inp">Name:</span> <input type="text" name="activity[name]"><br>
        <span class="form-inp">Point:</span> <input type="text" name="activity[point]"><br>
        <input type="submit" value="Submit">
    </form>
</div>