<?php

require_once "session_config.php";

//if user already logged in
if (isset($_SESSION["user_id"])) {
    header("Location: public/dashboard.php");
    exit;
} else {
    header("Location: public/signup.php");
    exit;
}