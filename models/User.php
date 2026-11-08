<?php

require_once "dbHandler.php";

class User extends dbHandler {

    //function to check if email used for signup is already registered
    public function alreadyRegistered($email) {
        try {
            $query = "SELECT id FROM users WHERE email = ?;";

            $stmt = $this->connect()->prepare($query);
            
            $stmt->execute([$email]);

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log("User::alreadyRegistered failed: " . $e->getMessage());
            return null;
        }
    }

    //only returns true or false on failure, NO redirections (that's handled by model class)
    public function addUser($email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try{
            $query = "INSERT INTO users (email, password) VALUES (?, ?);";
            $stmt = $this->connect()->prepare($query);
            if (!$stmt->execute([$email, $hashedPassword])) {
                $stmt = null;
                return false;
            } 
            return true;
        } catch (PDOException $e) {
            error_log("User::addUser failed: " . $e->getMessage());
            return null;
        }
    }

    //returns false if either email is not found or if password is wrong
    public function verifyCombination($email, $password) {
        
    
        $user = $this->getUserInfoByEmail($email);
        if (!$user) {
            return false;
        }

        $dbHashedPassword = $user["password"];

        if (password_verify($password, $dbHashedPassword)) { //not 100% sure if this should be done here in the model or in the controller
            return true;
        } else {
            return false;
        }

    }

    public function getUserInfoByEmail($email) {
        try {
            $query = "SELECT * FROM users WHERE email = ?;";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$email]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("User::getUserInfoByEmail failed: " . $e->getMessage());
            return false;
        }
    }

    public function getUserInfoByID($user_id) {
        try{
            $query = "SELECT * FROM users WHERE id = ?;";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$user_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("User::getUserInfoByID failed: " . $e->getMessage());
            return false;
        }
    }


    
}