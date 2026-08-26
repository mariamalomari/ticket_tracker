<?php

require_once "../session_config.php"; 

//clears the memory variables of $_SESSION
session_unset();

//deletes the session file from server
session_destroy();

setcookie(session_name(), "", [ //second argument is setting cookie to empty
    'expires' => time() - 3600,
    // 'domain' => 'localhost',
    'path' => '/',
    'secure'=> false , //for development only false cuz using xampp not https
    'httponly' => true 
]); //session_name - name of the current php session
//removing a cookie by setting an expiration time that has already passed (e.g., time() - 3600).

header("Location: login.php");
exit();