<?php
/**
 * Project: students-manager
 * User: mrmad
 * Date: 10.1.2016 г.
 * Time: 0:57
 */

?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students manager</title>
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_PATH ?>/public/css/app.css"/>
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,700,700italic' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="<?php echo BASE_PATH ?>/public/js/app.js"></script>
</head>
<body>
<div id="mainWrapper">
<header id="header">
	<a href="./index.php"><img id="logo" src="../public/img/logo.png" alt="Students manager system logo" /></a>
	<!-- h1 id="header-title"> Students manager system </h1-->
	<div id="menubar">
		<ul>
			<li><a href="./index.php?url=activities_student">Student activities</a></li>
			<li><a href="./index.php?url=activity">Activity</a></li>
			<li><a href="./index.php?url=categories_student">Student categories</a></li>
			<li><a href="./index.php?url=category">Categories</a></li>
			<li><a href="./index.php?url=statistic">Statistics</a></li>
			<li><a href="./index.php?url=students">Students Information</a></li>
		</ul>
	</div>
</header>
