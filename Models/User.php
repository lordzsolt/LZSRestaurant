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

    function __construct($id, $username, $password, $email, $name, $classId, $type) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $this->encryptPassword($password);
        $this->email = $email;
        $this->name = $name;
        $this->classId = $classId;
        $this->type = $type;
    }

    public static function getTable() {
        return 'user';
    }

    private function encryptPassword($password) {
        return $password;
    }
}