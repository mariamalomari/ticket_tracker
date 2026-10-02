<?php

require_once "../config/db.php";

//database handler
class dbHandler {

    private static $pdo = null; //static so all models use the same pdo

    //protected so no class is able to access this method 
    protected function connect() {
        if (self::$pdo == null) {
            try {
                $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME; 
                self::$pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD); //object representing db connection
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //if error, throw exception
                return self::$pdo;
            } catch (PDOException $e) {
                //log the actual error privately to server logs for debugging not on the browser  
                error_log("Database connection error: " . $e->getMessage());
                die("Connection failed, please try again later" ); //generic message on browser
            }

        } else {
            return self::$pdo;
        }
    }

}