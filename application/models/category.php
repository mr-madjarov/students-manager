<?php

/**
 * Project: students-manager
 * User: mrmad
 * Date: 10.1.2016 г.
 * Time: 22:27
 */
class Category extends Model {
    var $hasMany = array('StudentCategory' => 'StudentCategory');
    var $hasOne = array('Parent' => 'Category');

}