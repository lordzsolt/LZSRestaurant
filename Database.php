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
        }
        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function executeQuery($sql, $parameters = null) {
        if (is_null($this->connection)) {
            return null;
        }

        if (isset($parameters)) {
            $query = $this->connection->prepare($sql);
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $query->execute($parameters);
        }
        else {
            $query = $this->connection->query($sql, PDO::FETCH_ASSOC);
        }

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function executeCommand($sql, $parameters = null) {
        if (is_null($this->connection)) {
            return null;
        }

        if (isset($parameters)) {
            $query = $this->connection->prepare($sql);
            $result = $query->execute($parameters);
        }
        else {
            $result = $this->connection->exec($sql);
        }

        return $result;
    }


    public function lastInsertedId() {
        return $this->connection->lastInsertId();
    }
}