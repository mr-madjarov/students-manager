<?php
/**
 * Project: students-manager
 * User: mrmad
 * Date: 9.1.2016 г.
 * Time: 19:05
 */


/** Check if environment is development and display errors **/

function setReporting()
{
    if (DEVELOPMENT_ENVIRONMENT == true) {
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
    } else {
        error_reporting(E_ALL);
        ini_set('display_errors', 'Off');
        ini_set('log_errors', 'On');
        ini_set('error_log', ROOT . DS . 'tmp' . DS . 'logs' . DS . 'error.log');
    }
}

/** Check for Magic Quotes and remove them **/

function stripSlashesDeep($value)
{
    $value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
    return $value;
}

function removeMagicQuotes()
{
    if (get_magic_quotes_gpc()) {
        $_GET = stripSlashesDeep($_GET);
        $_POST = stripSlashesDeep($_POST);
        $_COOKIE = stripSlashesDeep($_COOKIE);
    }
}

/** Check register globals and remove them **/

function unregisterGlobals()
{
    if (ini_get('register_globals')) {
        $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
        foreach ($array as $value) {
            foreach ($GLOBALS[$value] as $key => $var) {
                if ($var === $GLOBALS[$key]) {
                    unset($GLOBALS[$key]);
                }
            }
        }
    }
}

/** Main Call Function **/

function callHook()
{
    global $url;
    global $default;

    try {
        if (!isset($url)) {
            $controller = $default['controller'];
            $action = $default['action'];
        } else {
            $urlArray = array();
            $urlArray = explode("/", $url);
            $controller = $urlArray[0];
            array_shift($urlArray);
            if (isset($urlArray[0]) and $urlArray[0] != '') {
                $action = $urlArray[0];
                array_shift($urlArray);
            } else {
                $action = 'index';
            }
            $queryString = $urlArray;

            $controllerName = $controller;
            $controller = ucwords($controller);
            $model = rtrim($controller, 's');
            $controller .= 'Controller';
            $dispatch = new $controller($model, $controllerName, $action);
        }
        if ((int)method_exists($controller, $action)) {
            call_user_func_array(array($dispatch,"beforeAction"),$queryString);
            call_user_func_array(array($dispatch,$action),$queryString);
            call_user_func_array(array($dispatch,"afterAction"),$queryString);
        } else {
            /* Error Generation Code Here */
            // var_dump("Error calback");exit;
        }
    } catch (OutOfBoundsException $e) {
        var_dump($e);
    } catch (Exception $e) {
        var_dump($e);
    }
}
/** Secondary Call Function **/

function performAction($controller,$action,$queryString = null,$render = 0) {

    $controllerName = ucfirst($controller).'Controller';
    $dispatch = new $controllerName($controller,$action);
    $dispatch->render = $render;
    return call_user_func_array(array($dispatch,$action),$queryString);
}

/** Autoload any classes that are required **/

function __autoload($className)
{
    if (file_exists(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php')) {
        require_once(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php');
    } else if (file_exists(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php')) {
        require_once(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php');
    } else if (file_exists(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php')) {
        require_once(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php');
    } else {
        /* Error Generation Code Here */
    }
}

setReporting();
removeMagicQuotes();
unregisterGlobals();
callHook();
