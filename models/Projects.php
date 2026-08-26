<?php

require_once "dbHandler.php";

class Projects extends dbHandler {

    //function to get all Projects name to show in dropdown
    public function getAllProjectsInfo() {
        $query = "SELECT * FROM projects;";

        $stmt = $this->connect()->prepare($query);
        
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); //fetching the row as an associative array
    
    }


    //havent used this yet
    //only returns true or false on failure, NO redirections (that's handled by model class)
    public function addProject($name, $description) {

        $query = "INSERT INTO projects (name, description) VALUES (?, ?);";
        $stmt = $this->connect()->prepare($query);
        if (!$stmt->execute([$name, $description])) {
            $stmt = null;
            return false;
        } 

        return true;
    }
    
}