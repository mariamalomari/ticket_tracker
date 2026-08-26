<?php

require_once "../session_config.php"; //we require cookies only in public entrypoints

require_once "../controllers/DashboardController.php";

//authentication before accessing anything
if(!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $ticket_id = $_POST["ticket_id"];
    $project_id = $_POST["project_id"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $category = $_POST["category"];
    $priority = $_POST["priority"];
    $status = $_POST["status"];



    $DashboardController = new DashboardController();
    $DashboardController->editTicket($ticket_id, $project_id, $title, $description, $category, $priority, $status);

} else {
    if(isset($_GET["id"])) {
        $ticket_id = $_GET["id"];
        $DashboardController = new DashboardController();
        $DashboardController->showEditTicketPage($ticket_id);
    } else {
        header("Location: ../public/allTickets.php");
        exit();
    }

}
