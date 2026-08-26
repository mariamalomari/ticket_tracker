<?php

require_once "../session_config.php"; //we require cookies only in public entrypoints

require_once "../controllers/DashboardController.php";

//authentication before accessing anything
if(!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    //POST request happens when deleting a ticket
    $DashboardController = new DashboardController();
    
    $filter = [
        "search" => $_GET["search"] ?? null,
        "created_by" => $_SESSION["user_id"],
        "title" => $_GET["titleSearch"] ?? null,
        "category" => $_GET["category"] ?? null,
        "status" => $_GET["status"] ?? null,
        "priority" => $_GET["priority"] ?? null,
    ];

    $message = null;

    //so when we reload we dont try to redelete it
    if ($DashboardController->deleteTicket($_POST["ticketIdToDelete"])) {
        header("Location: myTickets.php?success=successfully_deleted");
    } else {
        header("Location: myTickets.php?error=error_deleting");
    }

    exit();

} else {
    $DashboardController = new DashboardController();

    $filter = [
        "search" => $_GET["search"] ?? null,
        "created_by" => $_SESSION["user_id"],
        "project_id" => $_GET["project_id"] ?? null,
        "title" => $_GET["titleSearch"] ?? null,
        "category" => $_GET["category"] ?? null,
        "status" => $_GET["status"] ?? null,
        "priority" => $_GET["priority"] ?? null,
    ];

    if (isset($_GET["error"]) || isset($_GET["success"])) {
        $message = $_GET["error"] ?? $_GET["success"];
        $DashboardController->showMyTicketsPage($filter, $message);
    } else {
        $DashboardController->showMyTicketsPage($filter);

    }
}
