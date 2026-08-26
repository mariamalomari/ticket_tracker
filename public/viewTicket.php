<?php

require_once "../session_config.php"; //we require cookies only in public entrypoints

require_once "../controllers/DashboardController.php";

//authentication before accessing anything
if(!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    
} else {
    if(isset($_GET["id"])) {
        $ticket_id = $_GET["id"];
        $DashboardController = new DashboardController();
        $DashboardController->showViewTicketPage($ticket_id);
    } else {
        header("Location: ../public/allTickets.php");
        exit();

    }

}
