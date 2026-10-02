<?php

require_once "../models/Tickets.php";
require_once "../models/Projects.php";

class ProjectsController {


    public function showProjectsPage($message = null) {

        //for navbar
        $projectsModel = new Projects(); 
        $allProjectNames = $projectsModel->getAllProjectsInfo();

        $messageOutput = null;
        $color = null;
        if ($message == "not_found") {
            $messageOutput = "Project not found. Here are all project.";
            $color = "danger";
        }  else if ($message == "error_deleting") {
            $messageOutput = "There was an error in deleting your project. Please try again later.";
            $color = "danger";

        } else if ($message == "successfully_deleted") {
            $messageOutput = "project deleted successfully.";
            $color = "success";

        } else if ($message == "error_csrf") {
            $messageOutput = "CSRF ticket fail.";
            $color = "danger";
        } else if ($message == "no_permission") {
            $messageOutput = "You do not have permission to edit this project.";
            $color = "danger";
        } else if ($message == "successfully_created") {
            $messageOutput = "Successfully added Project.";
            $color = "success";
        }


        $projectsModel = new Projects();
        
        $projects = $projectsModel->getAllProjectsInfo();
        require_once "../views/projects.php";

    }


    function createNewProject($data) {
        //if theyre not admin --> they cant create 
        requireAdmin();

        $csrf_token = $data['csrf_token'] ?? null;
        $user_id = $_SESSION["user_id"] ?? null;

        if (!verifyCSRFtoken($csrf_token)) {
            header("Location: ../public/projects.php?error=error_csrf");
            exit(); 
        }

        //server-side validation for empty inputs
        if (empty($data['name']) || empty($data['description'])) {
            header("Location: ../public/projects.php?error=empty_fields");
            exit();
        }

        $projectsModel = new Projects();        
        
        $projectsModel->addProject($data['name'], $data['description'], $user_id);

        header("Location: ../public/projects.php?success=successfully_created");
        exit();
    }

    public function showEditProjectPage($project_id, $message = null) {
        //if theyre not admin --> they cant edit it    
        requireAdmin();


        if (!$project_id) {
            header("Location: ../public/projects.php?error=not_found");
            exit();
        }

        $projectsModel = new Projects();
        $projectInfo = $projectsModel->getProjectInfo($project_id);

        //if user did a get request manually to a projectid that doesnt exist, then redirect to projects page
        if (!$projectInfo) {
            header("Location: ../public/projects.php?error=not_found");
            exit();
        }

        //showing edit page after edit submission
        $messageOutput = null;
        $color = null;
        if ($message == "edit_error") {
            $messageOutput = "There was an error in updating the project. Please try again later.";
            $color = "danger";
        } else if ($message == "edit_success") {
            $messageOutput = "Successfully edited project.";
            $color = "success";
        } else if ($message == "edit_error_empty") {
            $messageOutput = "Please fill out all fields.";
            $color = "danger";
        } else if ($message == "error_invalid_option"){
            $messageOutput = "Invalid option selected for category, priority or status.";
            $color = "danger";
        } else if ($message == "error_csrf") {
            $messageOutput = "CSRF Token failed.";
            $color = "danger";
        }

        require_once "../views/editProject.php";
    }

    //called after post request on editing a project
    public function editProject($data) {
        //if theyre not admin --> they cant edit it
        requireAdmin();

        $csrf_token = $data['csrf_token'] ?? null;
        $user_id = $_SESSION["user_id"] ?? null;
        $project_id = $data["project_id"] ?? null;
        $name = $data["name"] ?? '';
        $description = $data["description"] ?? '';
        
        if (!verifyCSRFtoken($csrf_token)) {
            $this->showEditProjectPage($project_id, "error_csrf");
            return; 
        }

        $projectsModel = new Projects();

        //if any field is empty via raw post
        if (!$project_id || !$name || !$description ) {
            $this->showEditProjectPage($project_id, "edit_error_empty");
            return;
        }

        
        //updates project and sends appropriate message back on the projects page
        if ($projectsModel->updateProject($project_id, $name, $description)) {
            $this->showEditProjectPage($project_id, "edit_success");
        } else {
            $this->showEditProjectPage($project_id, "edit_error");
        }

    }

    public function deleteProject($data) {
        requireAdmin();

        $csrf_token = $data['csrf_token'] ?? null;
        $project_id = $data['projectIdToDelete'] ?? null;

        if (!verifyCSRFtoken($csrf_token)) {
            header("Location: ../public/projects.php?error=error_csrf");
            exit();
        }
        
        $projectsModel = new Projects();
        
        // $projectInfo = $projectsModel->getProjectInfo($project_id);

        if (!$project_id) {
            header("Location: ../public/projects.php?error=error_deleting");
            exit();
        }

        if ($projectsModel->deleteProject($project_id)) {
            header("Location: ../public/projects.php?success=successfully_deleted");
            exit();
        } else {
            header("Location: ../public/projects.php?error=error_deleting");
            exit();
        }

    }

    public function showViewProjectPage($project_id) {
        $projectsModel = new Projects();
        $projectInfo = $projectsModel->getProjectInfo($project_id);

        //if user did a get request manually to a ticketid that doesnt exist, then redirect to allTickets page
        if (!$projectInfo) {
            header("Location: ../public/projects.php?error=not_found");
            exit();
        }

        require_once "../views/viewProject.php";
    }



}