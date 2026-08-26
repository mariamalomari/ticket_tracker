<?php

require_once "../session_config.php"; //we require cookies only in public entrypoints

require_once "../controllers/DashboardController.php";

//authentication before accessing anything
if(!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") { //create new ticket form submitted
    $project_id = $_POST["project_id"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $category = $_POST["category"];
    $priority = $_POST["priority"];
    $status = $_POST["status"];

    $DashboardController = new DashboardController();

    $DashboardController->createNewTicket($project_id, $_SESSION["user_id"], $title, $description, $category, $priority, $status);

} else {
    $DashboardController = new DashboardController();
    $DashboardController->showMainDashboardPage(null, $_SESSION["user_id"]);
}
