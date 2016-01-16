<?php

/**
 * Project: students-manager
 * User: mrmad
 * Date: 9.1.2016 г.
 * Time: 19:47
 */
class SQLQuery
{
    protected $_dbHandle;
    protected $_result;

    protected $_describe = array();

    protected $_orderBy;
    protected $_order;
    protected $_extraConditions;
    protected $_hO;
    protected $_hM;
    protected $_hMABTM;
    protected $_page;
    protected $_limit;

    /** Connects to database **/

    function connect($address, $account, $pwd, $name)
    {
        $this->_dbHandle = mysqli_connect($address, $account, $pwd, $name);

        if (!$this->_dbHandle) {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }

        // echo "Success: A proper connection to MySQL was made!" . PHP_EOL;
        // echo "Host information: " . mysqli_get_host_info($this->_dbHandle) . PHP_EOL;

    }

    /** Disconnects from database **/

    function disconnect()
    {
        if (mysqli_close($this->_dbHandle) != 0) {
            return 1;
        } else {
            return 0;
        }
    }

    function selectAll()
    {
        $query = 'SELECT * FROM `' . $this->_table . '`';

        return $this->query($query);
    }

    function select($id)
    {
        $query = 'SELECT * FROM `' . $this->_table . '` WHERE `id` = \'' . mysql_real_escape_string($id) . '\'';
        return $this->query($query, 1);
    }


    /** Custom SQL Query **/

    function query($query, $singleResult = 0)
    {

        //$query = mysqli_real_escape_string($this->_dbHandle,$query);

        $this->_result = mysqli_query($this->_dbHandle, $query);


        if (preg_match("/select/i", $query)) {
            $result = array();
            $table = array();
            $field = array();
            $tempResults = array();
            $numOfFields = mysqli_num_fields($this->_result);
            for ($i = 0; $i < $numOfFields; ++$i) {

                $table_name = mysqli_fetch_field_direct($this->_result, $i);

                array_push($table, $table_name->table);

                $fld = mysqli_fetch_field_direct($this->_result, $i);

                array_push($field, $fld->name);
            }


            while ($row = mysqli_fetch_row($this->_result)) {
                for ($i = 0; $i < $numOfFields; ++$i) {
                    $table[$i] = trim(ucfirst($table[$i]), "s");
                    $tempResults[$table[$i]][$field[$i]] = $row[$i];
                }
                if ($singleResult == 1) {
                    mysqli_free_result($this->_result);
                    return $tempResults;
                }
                array_push($result, $tempResults);
            }
            mysqli_free_result($this->_result);
            return ($result);
        }


    }

    /** Get number of rows **/
    function getNumRows()
    {
        return mysql_num_rows($this->_result);
    }

    /** Free resources allocated by a query **/

    function freeResult()
    {
        mysqli_free_result($this->_result);
    }

    /** Get error string **/

    function getError()
    {
        return mysqli_error($this->_dbHandle);
    }

    /** Select Query **/

    function where($field, $value)
    {
        $this->_extraConditions .= '`' . $this->_model . '`.`' . $field . '` = \'' . mysqli_real_escape_string($this->_dbHandle, $value) . '\' AND ';
    }

    function like($field, $value)
    {
        $this->_extraConditions .= '`' . $this->_model . '`.`' . $field . '` LIKE \'%' . mysqli_real_escape_string($this->_dbHandle, $value) . '%\' AND ';
    }

    function showHasOne()
    {
        $this->_hO = 1;
    }

    function showHasMany()
    {
        $this->_hM = 1;
    }

    function showHMABTM()
    {
        $this->_hMABTM = 1;
    }

    function setLimit($limit)
    {
        $this->_limit = $limit;
    }

    function setPage($page)
    {
        $this->_page = $page;
    }

    function orderBy($orderBy, $order = 'ASC')
    {
        $this->_orderBy = $orderBy;
        $this->_order = $order;
    }

    /** Describes a Table **/

    protected function _describe()
    {
        try {
            $this->_describe = array();
            $query = 'DESCRIBE ' . $this->_table;
            $this->_result = mysqli_query($this->_dbHandle, $query);
            while ($row = mysqli_fetch_row($this->_result)) {
                array_push($this->_describe, $row[0]);
            }

        } catch (Exception $e) {
            var_dump($e);
            exit;
        }
    }

    function delete()
    {
        if ($this->id) {
            $query = 'DELETE FROM ' . $this->_table . ' WHERE `id`=\'' . mysql_real_escape_string($this->id) . '\'';
            $this->_result = mysqli_query($this->_dbHandle, $query);
            $this->clear();
            if ($this->_result == 0) {
                /** Error Generation **/
                return -1;
            }
        } else {
            /** Error Generation **/
            return -1;
        }

    }

    /** Saves an Object i.e. Updates/Inserts Query **/

    function save()
    {
        try {
            $this->_describe();
            //var_dump($this->_describe);exit;
            $query = '';
            if (isset($this->id)) {
                $updates = '';
                foreach ($this->_describe as $field) {
                    if ($this->$field) {
                        $updates .= '`' . $field . '` = \'' . mysqli_real_escape_string($this->_dbHandle, $this->$field) . '\',';
                    }
                }

                $updates = substr($updates, 0, -1);

                $query = 'UPDATE ' . $this->_table . ' SET ' . $updates . ' WHERE `id`=\'' . mysqli_real_escape_string($this->_dbHandle, $this->id) . '\'';
            } else {
                $fields = '';
                $values = '';

                foreach ($this->_describe as $field) {
                    if ($this->$field) {
                        $fields .= '`' . $field . '`,';
                        $values .= '\'' . mysqli_real_escape_string($this->_dbHandle, $this->$field) . '\',';
                    }
                }

                $values = substr($values, 0, -1);
                $fields = substr($fields, 0, -1);


                $query = 'INSERT INTO ' . $this->_table . ' (' . $fields . ') VALUES (' . $values . ')';
            }
            $this->_result = mysqli_query($this->_dbHandle, $query);
            $this->clear();
            if ($this->_result == 0) {
                /** Error Generation **/
                return false;
            }else{
                return true;
            }
        } catch (Exception $e) {
            var_dump($e);
            exit;
        }
    }

    /** Clear All Variables **/

    function clear()
    {
        foreach ($this->_describe as $field) {
            $this->$field = null;
        }

        $this->_orderby = null;
        $this->_extraConditions = null;
        $this->_hO = null;
        $this->_hM = null;
        $this->_hMABTM = null;
        $this->_page = null;
        $this->_order = null;
    }

}
