<?php
/**
 * Project: students-manager
 * User: mrmad
 * Date: 29.1.2016 г.
 * Time: 19:24
 */
if(isset($_SESSION['user'])){
    header("Location:index.php?url=students");
}
?>
<div id="login-controls">
    <h2> Login </h2>

    <form method="POST" action="index.php?url=users/login" >
        <?php if(@$_GET['url'] == "users/index/err"){?>
            <span style="color: #f00">Login incorrect. Please try again! </span><br>
        <?php } ?>
        <label for="user" class="form-inp">Username</label>
        <input type="text" name="username" id="user"><br>
        <label for="pass" class="form-inp">Password</label>
        <input type="password" name="password" id="pass"><br>
        <input type="submit" name='login' value="Submit">
    </form>
</div>
