<?php

    require_once "../models/Projects.php";
    require_once "../models/Tickets.php";
    require_once "../models/User.php";


    class DashboardController {


        public function showMainDashboardPage($message = null, $user_id) { //user_id passed so we can show their total number of active tickets
            $projectsModel = new Projects(); 

            $allProjectNames = $projectsModel->getAllProjectsInfo();

            $ticketsModel = new Tickets();
            $openTicketsNumber = $ticketsModel->numberOfTickets("Open");
            $highPriorityTicketsNumber = $ticketsModel->numberOfTickets("high_priority");
            $myTicketsNumber = $ticketsModel->numberOfTickets("my_tickets", $user_id);

            $messageOutput = null;
            $color = null;
            if ($message == "ticketCreated") {
                $messageOutput = "Ticket Successfully Created";
                $color = "success";
            } else if ($message == "error") {
                $messageOutput = "There was an error in creating your ticket, please try again later.";
                $color = "danger";
            }

            require_once "../views/dashboard.php";

        }

        public function showAllTicketsPage($filter = [], $message = null) {
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

            }

            $ticketsModel = new Tickets();
            
            $tickets = $ticketsModel->getFilteredTickets($filter);

            require_once "../views/allTickets.php";
        }

        public function showMyTicketsPage($filter, $message = null) { //must pass user_id in filter
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
            }

            $ticketsModel = new Tickets();
            
            $tickets = $ticketsModel->getFilteredTickets($filter);

            require_once "../views/myTickets.php";
        }


        public function createNewTicket($project_id, $user_id, $title, $description, $category, $priority, $status) {

            $ticketsModel = new Tickets();
            if ($ticketsModel->addTicket($project_id, $user_id, $title, $description, $category, $priority, $status)) {
                $this->showMainDashboardPage("ticketCreated", $user_id);
            } else {
                $this->showMainDashboardPage("error", $user_id);
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


            //showing edit page after edit submission
            $messageOutput = null;
            $color = null;
            if ($message == "edit_error") {
                $messageOutput = "There was an error in updating the ticket. Please try again later.";
                $color = "danger";
            } else if ($message == "edit_success") {
                $messageOutput = "Successfully edited ticket.";
                $color = "success";
            }

            require_once "../views/editTicket.php";
        }

        //called after post request on editing a ticket
        public function editTicket($ticket_id, $project_id, $title, $description, $category, $priority, $status) {
            $ticketsModel = new Tickets();
            
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

        public function deleteTicket($ticket_id) {
            $ticketsModel = new Tickets();
            return $ticketsModel->deleteTicket($ticket_id);
        }

        public function showProfilePage($user_id) {
            //for navbar
            $projectsModel = new Projects(); 
            $allProjectNames = $projectsModel->getAllProjectsInfo();
            
            $userModel = new User();
            $userInfo = $userModel->getUserInfoById($user_id);
            $user_email = $userInfo["email"];
            require_once "../views/profile.php";
        }

    }

