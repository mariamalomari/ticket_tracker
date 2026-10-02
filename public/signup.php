<?php

require_once "../session_config.php"; //we require cookies only in public entrypoints

//instantiating the class 
require_once "../controllers/AuthenticationController.php";
$authenticationController = new AuthenticationController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $authenticationController->registerUser($_POST);

} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $error = $_GET["error"] ?? null;
    $authenticationController->showSignupPage($error);
} 
