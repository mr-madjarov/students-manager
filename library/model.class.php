<?php

/**
 * Project: students-manager
 * User: mrmad
 * Date: 9.1.2016 г.
 * Time: 19:40
 */
class Model extends SQLQuery
{
    protected $_model;

    function __construct()
    {
        $this->connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $this->_model = get_class($this);
        $this->_table = strtolower($this->_model) . "s";
    }

    function __destruct()
    {

    }
}