<?php

require_once "../session_config.php"; //we require cookies only in public entrypoints

require_once "../controllers/TicketController.php";

requireAuth();


if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $ticketController = new TicketController();
    $ticketController->editTicket($_POST);

} else {
    if(isset($_GET["id"])) {
        $ticket_id = $_GET["id"];
        $message = $_GET["error"] ?? $_GET["success"] ?? null;
        $ticketController = new TicketController();
        $ticketController->showEditTicketPage($ticket_id, $message);
    } else {
        header("Location: ../public/allTickets.php");
        exit();
    }

}
