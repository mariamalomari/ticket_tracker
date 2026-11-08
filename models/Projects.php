<?php

require_once "dbHandler.php";

class Projects extends dbHandler {

    //function to get all Projects name to show in dropdown
    public function getAllProjectsInfo() {
        try {
            $query = "SELECT * FROM projects;";

            $stmt = $this->connect()->prepare($query);
            
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC); //fetching the row as an associative array
        } catch (PDOException $e) {
            error_log("Projects::getAllProjectsInfo failed: " . $e->getMessage());
            return [];
        }
    }

    public function getProjectInfo($projectId) {
        try{ 
            $query = "SELECT * FROM projects WHERE id = ?;";

            $stmt = $this->connect()->prepare($query);
            
            $stmt->execute([$projectId]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Projects::getProjectInfo failed: " . $e->getMessage());
            return false;
        }

    }



    //havent used this yet
    //only returns true or false on failure, NO redirections (that's handled by model class)
    public function addProject($name, $description, $created_by) {
        try {
            $query = "INSERT INTO projects (name, description, created_by) VALUES (?, ?, ?);";
            $stmt = $this->connect()->prepare($query);
            return $stmt->execute([$name, $description, $created_by]);
        } catch (PDOException $e) {
            error_log("Projects::addProject failed: " . $e->getMessage());
            return false;
        }
    }


    public function updateProject($project_id, $name, $description) {
        try { 
            $query = "UPDATE projects SET name = ?, description = ? WHERE id = ?;";

            $stmt = $this->connect()->prepare($query);
            
            return $stmt->execute([$name, $description, $project_id]);
        } catch (PDOException $e) {
            error_log("Projects::updateProject failed: " . $e->getMessage());
            return false;
        }
    }

    public function deleteProject($projectId) {
        try {
            $query = "DELETE FROM projects WHERE id = ?;";

            $stmt = $this->connect()->prepare($query);
            
            return $stmt->execute([$projectId]);
        } catch (PDOException $e) {
            error_log("Projects::deleteProject failed: " . $e->getMessage());
            return false;
        }
    }



    
}