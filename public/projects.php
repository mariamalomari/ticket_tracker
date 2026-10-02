<?php

require_once "../session_config.php"; //we require cookies only in public entrypoints

require_once "../controllers/ProjectsController.php";

requireAuth();

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    //POST request happens when deleting a project or creating a new project
    $projectsController = new ProjectsController();
    if (isset($_POST['action']) && $_POST['action'] === 'delete') {
        $projectsController->deleteProject($_POST);
    } else {
        $projectsController->createNewProject($_POST);
    }

} else {
    $projectsController = new ProjectsController();


     if (isset($_GET["error"]) || isset($_GET["success"])) {
        $message = $_GET["error"] ?? $_GET["success"];
        $projectsController->showProjectsPage($message);
    } else {
        $projectsController->showProjectsPage();

    }

}
