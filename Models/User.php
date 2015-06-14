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

    public static function getTable() {
        return 'user';
    }

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

    public function getUserWithCredentials($identifier, $password) {

        $result = $this->getAllWhere('username = ? OR email = ?', [$identifier, $identifier]);
        if (count($result) == 0) {
            return null;
        }

        $foundUser = $result[0];
        if (!$foundUser->comparePassword($password)) {
            return null;
        }

        return $foundUser;
    }

    public function getCookieInfo() {
        return [
            'userId' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'userType' => $this->type
        ];
    }

    private static function encryptPassword($password) {
        $options = [
            'cost' => 10
        ];
        $hash = password_hash($password, PASSWORD_BCRYPT, $options);
        return $hash;
    }

    private function comparePassword($password) {
        return password_verify($password, $this->password);
    }
}