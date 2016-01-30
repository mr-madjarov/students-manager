<?php

/**
 * Project: students-manager
 * User: mrmad
 * Date: 10.1.2016 г.
 * Time: 0:45
 */
class User extends Model
{

    protected $id;
    protected $username;
    protected $password;


    function __construct()
    {
        parent::__construct();
    }

    function User($username)
    {

        $this->username = $username;
    }


    function getUsername()
    {
        return $this->username;
    }

    function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


}