<?php

require_once "../session_config.php"; //we require cookies only in public entrypoints

require_once "../controllers/TicketController.php";

//authentication before accessing anything
requireAuth();


if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    //POST request happens when deleting a ticket
    $ticketController = new TicketController();
    
    //so when we reload we dont try to redelete it --> header
    $deleting_status = $ticketController->deleteTicket($_POST);
    if ($deleting_status == "successfully_deleted") {
        header("Location: myTickets.php?success=successfully_deleted");
    } else {
        header("Location: myTickets.php?error=" . $deleting_status);
    }
    exit();

} else {
    $ticketController = new TicketController();

    if (isset($_GET["error"]) || isset($_GET["success"])) {
        $message = $_GET["error"] ?? $_GET["success"];
        $ticketController->showMyTicketsPage($_GET, $message);
    } else {
        $ticketController->showMyTicketsPage($_GET);

    }
}
