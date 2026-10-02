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

    public function getProjectInfo($projectId) {
        $query = "SELECT * FROM projects WHERE id = ?;";

        $stmt = $this->connect()->prepare($query);
        
        $stmt->execute([$projectId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }



    //havent used this yet
    //only returns true or false on failure, NO redirections (that's handled by model class)
    public function addProject($name, $description, $created_by) {

        $query = "INSERT INTO projects (name, description, created_by) VALUES (?, ?, ?);";
        $stmt = $this->connect()->prepare($query);
        if (!$stmt->execute([$name, $description, $created_by])) {
            $stmt = null;
            return false;
        } 

        return true;
    }


    public function updateProject($project_id, $name, $description) {
        $query = "UPDATE projects SET name = ?, description = ? WHERE id = ?;";

        $stmt = $this->connect()->prepare($query);
        
        return $stmt->execute([$name, $description, $project_id]);

    }

    public function deleteProject($projectId) {
        $query = "DELETE FROM projects WHERE id = ?;";

        $stmt = $this->connect()->prepare($query);
        
        return $stmt->execute([$projectId]);
    }



    
}