<?php

require_once "../config/db.php";

//database handler
class dbHandler {

    //protected so no class is able to access this method 
    protected function connect() {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME; 
            $pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD); //object representing db connection
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //if error, throw exception
            return $pdo;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

}