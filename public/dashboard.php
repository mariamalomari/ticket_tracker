<?php

require_once "../session_config.php"; //we require cookies only in public entrypoints

require_once "../controllers/DashboardController.php";
require_once "../controllers/TicketController.php";

requireAuth();

if ($_SERVER["REQUEST_METHOD"] == "POST") { //create new ticket form submitted

    $TicketController = new ticketController();

    $TicketController->createNewTicket($_POST);

} else {
    $DashboardController = new DashboardController();
    $message = $_GET["error"] ?? $_GET["success"] ?? null;
    $DashboardController->showMainDashboardPage($_SESSION["user_id"], $message);
}
