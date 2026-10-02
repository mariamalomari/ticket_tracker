<?php

require_once "../session_config.php"; 
require_once "../controllers/AuthenticationController.php";


$authenticationController = new AuthenticationController();

$authenticationController->logout();