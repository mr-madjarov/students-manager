<?php
/**
 * User: Madjarov
 * Date: 9.1.2016 г.
 * Time: 18:53
 */

/**
 *  set the $url variable
 *  calls bootstrap.php which resides in library directory
 */
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

/**
 * in .htacces we redirect all request through /index.php?url=
 */
if(isset($_GET['url'])){
    $url = $_GET['url'];
}else{
    $url="students/index";
}

require_once(ROOT . DS . 'library' . DS . 'bootstrap.php');