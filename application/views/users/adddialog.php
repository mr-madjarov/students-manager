<?php
/**
 * Project: students-manager
 * User: mrmad
 * Date: 30.1.2016 г.
 * Time: 20:29
 */
if (!isset($_SESSION['user'])) {
    header("Location:index.php?url=users/index");
}
?>
<div id="login-controls">
    <h2> Add user </h2>

    <form method="POST" action="index.php?url=users/add">
        <?php if (@$_GET['url'] == "users/addialog/err") { ?>
            <span style="color: #f00">Login incorrect. Please try again! </span><br>
        <?php } ?>
        <label for="user" class="form-inp">Username</label>
        <input type="text" name="username" id="user"><br>
        <label for="pass" class="form-inp">Password</label>
        <input type="password" name="password" id="pass"><br>
        <input type="submit" value="Submit">
    </form>
</div>