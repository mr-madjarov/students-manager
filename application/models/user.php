<?php

/**
 * Project: students-manager
 * User: mrmad
 * Date: 10.1.2016 г.
 * Time: 0:45
 */
class User extends Model
{

    private $username;
    function __construct()
    {
        parent::__construct();
    }

    function User($username) {

        $this->username = $username;
    }


    function get_username( ) {
        return $this->username;
    }

    function set_username($username) {
        $this->username = $username;
    }


}