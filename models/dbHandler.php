<?php
//database handler
class dbHandler {
    private $dsn = "mysql:host=127.0.0.1;dbname=jaser_task_1";
    private $username = 'root';
    private $password = '';

    //protected so no class is able to access this method 
    protected function connect() {
        try {
            $pdo = new PDO($this->dsn, $this->username, $this->password); //object representing db connection
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //if error, throw exception
            return $pdo;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

}