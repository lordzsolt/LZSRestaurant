<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lord Zsolt
 * Date: 14/06/2015
 * Time: 01:11
 */

class User extends MVCModelBase {

    public $id;

    public $username;

    public $password;

    public $email;

    public $name;

    public $classId;

    public $type;

    public static function createWithParameters($app, $id, $username, $password, $email, $name, $classId, $type) {
        $instance = new self($app);
        $instance->id = $id;
        $instance->username = $username;
        $instance->password = static::encryptPassword($password);
        $instance->email = $email;
        $instance->name = $name;
        $instance->classId = $classId;
        $instance->type = $type;

        return $instance;
    }

    public static function getTable() {
        return 'user';
    }

    private static function encryptPassword($password) {
        return $password;
    }
}