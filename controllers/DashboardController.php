<?php

    require_once "../models/Projects.php";
    require_once "../models/Tickets.php";
    require_once "../models/User.php";


    class DashboardController {


        public function showMainDashboardPage($user_id, $message = null) { //user_id passed so we can show their total number of active tickets
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
            } else if ($message == "error_empty_input") {
                $messageOutput = "Please make sure to fill in all the fields.";
                $color = "danger";
            } else if ($message == "error_invalid_option") {
                $messageOutput = "Invalid option selected for category, priority or status.";
                $color = "danger";
            } else if ($message == "error_csrf") {
                $messageOutput = "CSRF token error."; //???????????
                $color = "danger";

            }

            require_once "../views/dashboard.php";

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

