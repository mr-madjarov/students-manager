<?php

/**
 * Project: students-manager
 * User: mrmad
 * Date: 10.1.2016 г.
 * Time: 22:30
 */
class CategoryController extends Controller
{
    function beforeAction()
    {

    }
    function add()
    {
        $model = new Category();

        // var_dump($_POST);exit;
        if (isset($_POST['category']) and $_POST['category']['name'] != '') {
            $category = $_POST['category'];
            $name = $category['name'];
            $parent_id = $category['parent_id'];
            $model->name = $name;
            $model->parent_id = $parent_id;

            if ($model->save()) {
                header('Location: ' . 'index.php?url=categorys/index');
                die();
            }
        } else {
            $this->set("title", "Error! Empty field!");

        }

    }

    function index()
    {
        $this->set('categories', $this->loadModel()->selectAll());
    }

    public function loadModel()
    {
        $model = new $this->_model;

        return $model;
    }
    function afterAction()
    {

    }


}