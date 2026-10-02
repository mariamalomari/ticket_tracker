<?php

require_once "../session_config.php"; //we require cookies only in public entrypoints

require_once "../controllers/ProjectsController.php";

//authentication before accessing anything
if(!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    
} else {
    if(isset($_GET["id"])) {
        $project_id = $_GET["id"];
        $projectsController = new ProjectsController();
        $projectsController->showViewProjectPage($project_id);
    } else {
        header("Location: ../public/projects.php");
        exit();

    }

}
