<?php

/**
 * Project: students-manager
 * User: mrmad
 * Date: 10.1.2016 г.
 * Time: 0:45
 */
class Student extends Model
{
    public $id;
    public $first_name;
    public $last_name;
    public $f_number;
    public $group;
    public $flow;
    public $alumni;
    public $subject;


    public function listStudents(){
        $model = strtolower($this->_model);
        return $this->selectAll();
    }


}