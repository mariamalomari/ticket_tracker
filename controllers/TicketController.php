<?php

require_once "../models/Tickets.php";
require_once "../models/Projects.php";

class TicketController {

    private function renderTicketList($viewName, $filter = [], $message = null) {
        //for navbar
        $projectsModel = new Projects(); 
        $allProjectNames = $projectsModel->getAllProjectsInfo();

        $messageOutput = null;
        $color = null;
        if ($message == "not_found") {
            $messageOutput = "Ticket not found. Here are all tickets.";
            $color = "danger";
        }  else if ($message == "error_deleting") {
            $messageOutput = "There was an error in deleting your ticket. Please try again later.";
            $color = "danger";

        } else if ($message == "successfully_deleted") {
            $messageOutput = "Ticket deleted successfully.";
            $color = "success";

        } else if ($message == "error_csrf") {
            $messageOutput = "CSRF ticket.";
            $color = "danger";
        } else if ($message == "no_permission") {
            $messageOutput = "You do not have permission to edit this ticket.";
            $color = "danger";
        }


        $ticketsModel = new Tickets();
        
        $tickets = $ticketsModel->getFilteredTickets($filter);
        require_once "../views/{$viewName}.php";

    }
    public function showAllTicketsPage($filter = [], $message = null) {
        $this->renderTicketList("allTickets", $filter, $message);

    }

    public function showMyTicketsPage($filter = [], $message = null) { //must pass user_id in filter
        $filter['created_by'] = $_SESSION['user_id'];
        $this->renderTicketList("myTickets", $filter, $message);
    }


    public function createNewTicket($data) {

        $csrf_token = $data['csrf_token'] ?? null;
        $user_id = $_SESSION["user_id"] ?? null;

        if (!verifyCSRFtoken($csrf_token)) {
            header("Location: dashboard.php?error=error_csrf");
            exit(); 
        }

        //csrf verified
        $project_id = $data["project_id"] ?? null;
        $title = $data["title"] ?? '';
        $description = $data["description"] ?? '';
        $category = $data["category"] ?? '';
        $priority = $data["priority"] ?? '';
        $status = $data["status"] ?? '';

        $ticketsModel = new Tickets();

        //if any of the inputs are empty (which can be done via raw non-browser POST request because we have browser-side validation)
        if (!$project_id || !$user_id || !$title || !$description || !$category || !$priority || !$status) {
            header("Location: dashboard.php?error=error_empty_input");
            exit();
        }
        

        //category, priority and status must be of these options only  (again need this server side validation cuz of raw post requests)
        $allowed_categories =["Frontend", "Backend", "Database"];
        $allowed_priorities = ["Low", "Medium", "High"];
        $allowed_statuses = ["Open", "In progress", "Closed"];

        if (!in_array($category, $allowed_categories) || !in_array($priority, $allowed_priorities) || !in_array($status, $allowed_statuses)) {
            header("Location: dashboard.php?error=error_invalid_option");
            exit();
        }


        if ($ticketsModel->addTicket($project_id, $user_id, $title, $description, $category, $priority, $status)) {
            header("Location: dashboard.php?success=ticketCreated");
            exit();
        } else {
            header("Location: dashboard.php?error=error");
            exit();
        }


    }

    public function showEditTicketPage($ticket_id, $message = null) {
        $ticketsModel = new Tickets();
        $ticketInfo = $ticketsModel->getTicketInfo($ticket_id);

        $projectsModel = new Projects();
        $allProjectNames = $projectsModel->getAllProjectsInfo();

        //if user did a get request manually to a ticketid that doesnt exist, then redirect to allTickets page
        if (!$ticketInfo) {
            header("Location: ../public/allTickets.php?error=not_found");
            exit();
        }

        //if it's not created by them --> they cant edit it
        if ($ticketInfo['created_by'] != $_SESSION['user_id']) {
            header("Location: ../public/allTickets.php?error=no_permission");
            exit();
        }

        //showing edit page after edit submission
        $messageOutput = null;
        $color = null;
        if ($message == "edit_error") {
            $messageOutput = "There was an error in updating the ticket. Please try again later.";
            $color = "danger";
        } else if ($message == "edit_success") {
            $messageOutput = "Successfully edited ticket.";
            $color = "success";
        } else if ($message == "edit_error_empty") {
            $messageOutput = "Please fill out all fields.";
            $color = "danger";
        } else if ($message == "error_invalid_option"){
            $messageOutput = "Invalid option selected for category, priority or status.";
            $color = "danger";
        } else if ($message == "error_csrf") {
            $messageOutput = "CSRF Token failed.";
            $color = "danger";
        }

        require_once "../views/editTicket.php";
    }

    //called after post request on editing a ticket
    public function editTicket($data) {

        $csrf_token = $data['csrf_token'] ?? null;
        $user_id = $_SESSION["user_id"] ?? null;
        $ticket_id = $data["ticket_id"] ?? null;
        $project_id = $data["project_id"] ?? null;
        $title = $data["title"] ?? '';
        $description = $data["description"] ?? '';
        $category = $data["category"] ?? '';
        $priority = $data["priority"] ?? '';
        $status = $data["status"] ?? '';

        if (!verifyCSRFtoken($csrf_token)) {
            $this->showEditTicketPage($ticket_id, "error_csrf");
            return; 
        }

        $ticketsModel = new Tickets();

        $ticket_info = $ticketsModel->getTicketInfo($ticket_id);

        //if it's not created by them --> they cant edit it
        if (!$ticket_info || $ticket_info['created_by'] != $_SESSION['user_id']) {
            header("Location: ../public/allTickets.php?error=no_permission");
            exit();
        }
        

        //if any field is empty via raw post
        if (!$ticket_id || !$project_id || !$title || !$description || !$category || !$priority || !$status) {
            $this->showEditTicketPage($ticket_id, "edit_error_empty");
            return;
        }

        //category, priority and status must be of these options only  (again need this server side validation cuz of raw post requests)
        $allowed_categories =["Frontend", "Backend", "Database"];
        $allowed_priorities = ["Low", "Medium", "High"];
        $allowed_statuses = ["Open", "In progress", "Closed"];

        if (!in_array($category, $allowed_categories) || !in_array($priority, $allowed_priorities) || !in_array($status, $allowed_statuses)) {
            $this->showEditTicketPage($ticket_id, "error_invalid_option");
            return;
        }
        
        //updates ticket and sends appropriate message back on the allticketspage
        if ($ticketsModel->updateTicket($ticket_id, $project_id, $title, $description, $category, $priority, $status)) {
            $this->showEditTicketPage($ticket_id, "edit_success");
        } else {
            $this->showEditTicketPage($ticket_id, "edit_error");
        }

    }

    public function showViewTicketPage($ticket_id) {
        $ticketsModel = new Tickets();
        $ticketInfo = $ticketsModel->getTicketInfo($ticket_id);

        //if user did a get request manually to a ticketid that doesnt exist, then redirect to allTickets page
        if (!$ticketInfo) {
            header("Location: ../public/allTickets.php?error=not_found");
            exit();
        }

        require_once "../views/viewTicket.php";
    }

    //it deletes and returns the status instead of redirecting here so we dont redirect strictly to allticket
    //page , cuz it can be called from mytickets as well for example
    public function deleteTicket($data) {
        $csrf_token = $data['csrf_token'] ?? null;
        $ticket_id = $data['ticketIdToDelete'] ?? null;
        $user_id = $_SESSION["user_id"] ?? null;

        if (!verifyCSRFtoken($csrf_token)) {
            return "error_csrf";
        }
        
        $ticketsModel = new Tickets();
        
        $ticketInfo = $ticketsModel->getTicketInfo($ticket_id);

        //verifying ownership before deleting
        if (!$ticketInfo || $ticketInfo['created_by'] != $user_id) {
            return "no_permission";
        }

        return $ticketsModel->deleteTicket($ticket_id) ? "successfully_deleted" : "error_deleting";
    }

}