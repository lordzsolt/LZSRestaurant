<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lord Zsolt
 * Date: 13/06/2015
 * Time: 13:48
 */

abstract class  MVCModelBase {

    private $application;

    abstract static function getTable();

    function __construct($app) {
        if (!isset($app) || !is_a($app, 'MVC')) {
            throw new Exception('The $app argument must point to a valid MVC application.');
        }
        $this->application = $app;
    }

    public function getAllWhere($whereClause = null, $parameters = null) {
        $sql = 'select * from '.static::getTable();

        if (!is_null($whereClause)) {
            $sql .= ' where '.$whereClause;
        }

        $result = $this->application->database->executeQuery($sql, $parameters);

        $class = get_class($this);
        foreach($result as $item) {
            $object = new $class($this->application);

            foreach ($item as $key => $value) {
                $object->$key = $value;
            }

            $result[] = $object;
        }

        return $result;
    }

    public function save() {
        $fields = $this->getAllFields();

        //Shift to remove id field
        array_shift($fields);

        if (isset($this->id)) {
            $sql = 'update '.$this->getTable().' set ';
            $parameters = [];

            foreach ($fields as $field) {
                $sql .= $field.' = ?, ';
                $parameters[] = $this->$field;
            }

            $sql = rtrim($sql, ', ').' where id = ? limit 1';
            $parameters[] = $this->id;
        }
        else {
            $sql = 'insert into '.$this->getTable().' ('.join(', ', $fields).') values (';
            $parameters = [];

            foreach ($fields as $field) {
                $sql .= '?, ';
                $parameters[] = $this->$field;
            }

            $sql = rtrim($sql, ', ').')';
        }

        $result = $this->application->database->executeCommand($sql, $parameters);

        if (!is_null($result) && !isset($this->id)) {
            $this->id = (int)$this->application->database->lastInsertedId();
        }
    }

    private function getAllFields() {
        $fields = [];

        $reflection = new ReflectionClass($this);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);

        foreach ($properties as $property) {
            $fields[] = $property->name;
        }

        return $fields;
    }

}