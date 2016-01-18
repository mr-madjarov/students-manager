<?php

/**
 * Project: students-manager
 * User: mrmad
 * Date: 9.1.2016 г.
 * Time: 19:21
 */

/**
 * Class Controller
 * Base controller does communication between the controller,
 *                                            the model and
 *                                            the view (template class)
 */
class Controller
{
    protected $_model;
    protected $_controller;
    protected $_action;
    protected $_template;

    public $doNotRenderHeader;
    public $render;

    function __construct($model, $controller, $action)
    {

        $this->_controller = $controller;
        $this->_action = $action;
        $this->_model = $model;

        $this->doNotRenderHeader = 0;
        $this->render = 1;

        $this->$model = new $model;
        $this->_template = new Template($controller, $action);

    }

    function set($name, $value)
    {
        $this->_template->set($name, $value);
    }

    function __destruct()
    {
        if ($this->render) {
            $this->_template->render($this->doNotRenderHeader);
        }
    }
}
