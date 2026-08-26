<?php

require_once "../session_config.php"; //we require cookies only in public entrypoints

require_once "../controllers/LoginController.php";

$loginController = new LoginController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $loginController->loginUser($email, $password);

} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $error = $_GET["error"] ?? null;
    $loginController->showLoginPage($error);
}