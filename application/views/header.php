<?php
/**
 * Project: students-manager
 * User: mrmad
 * Date: 10.1.2016 г.
 * Time: 0:57
 */
session_start();
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students manager</title>
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_PATH ?>/public/css/app.css"/>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic&subset=latin,cyrillic-ext'
          rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="<?php echo BASE_PATH ?>/public/js/app.js"></script>
</head>
<body>
<div id="mainWrapper">
    <header id="header">
        <a href="./index.php"><div id="logo"></div></a>
        <div id="header-welcome">
            <?php

            if (isset($_SESSION['user'])) {
                echo "<span>Welcome,  " . $_SESSION['user']->getUsername() . "!</span>  ";
                echo "<a href=\"./index.php?url=users/logout\">Logout</a>";
            }else{
                echo "<a href=\"./index.php?url=users\">Login</a>";
            }
            ?>

        </div>
        <div id="menubar">
            <ul>
                <li><a href="./index.php?url=students">Students</a></li>
                <li><a href="./index.php?url=activities_student">Activities</a></li>
                <li><a href="./index.php?url=statistic">Statistics</a></li>
                <li><a href="./index.php?url=activity">Tasks</a></li>
                <li><a href="./index.php?url=category">Categories</a></li>
                <?php if (isset($_SESSION['user'])) {?>
                <li><a href="./index.php?url=users/view">Users</a></li>
                <?php } ?>
            </ul>
        </div>
    </header>
