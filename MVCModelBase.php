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