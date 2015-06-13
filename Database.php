<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lord Zsolt
 * Date: 13/06/2015
 * Time: 20:08
 */

class Database {

    public $databaseName;

    private $connection;

    function __construct($serverName, $dbName, $username, $password) {
        $this->databaseName = $dbName;

        try {
            $this->connection = new PDO("mysql:host=$serverName;dbname=$this->databaseName", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        }
        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

}