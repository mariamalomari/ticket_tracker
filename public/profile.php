<?php

require_once "../session_config.php"; //we require cookies only in public entrypoints

require_once "../controllers/DashboardController.php";

//authentication before accessing anything
requireAuth();


if ($_SERVER["REQUEST_METHOD"] == "POST") { //create new ticket form submitted

} else {
    $DashboardController = new DashboardController();
    $DashboardController->showProfilePage($_SESSION["user_id"]);
}
