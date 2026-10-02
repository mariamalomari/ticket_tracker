<?php

require_once "../session_config.php"; //we require cookies only in public entrypoints

require_once "../controllers/ProjectsController.php";

requireAuth();


if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $projectController = new ProjectsController();
    $projectController->editProject($_POST);

} else {
    if(isset($_GET["id"])) {
        $project_id = $_GET["id"];
        $projectController = new ProjectsController();
        $projectController->showEditProjectPage($project_id);
    } else {
        header("Location: ../public/projects.php");
        exit();
    }

}
