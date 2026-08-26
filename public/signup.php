<?php

require_once "../session_config.php"; //we require cookies only in public entrypoints

//instantiating the class 
require_once "../controllers/SignupController.php";
$signupController = new SignupController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repeatedPassword = $_POST["repeatedPassword"];
    
    $signupController->registerUser($email, $password, $repeatedPassword);

} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $error = $_GET["error"] ?? null;
    $signupController->showSignupPage($error);
} 
