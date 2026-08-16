<?php
//so we can just require it in every page we need cookies in instead of rewriting

ini_set("session.use_only_cookies", 1); //use cookies for sessionid
ini_set("session.use_strict_mode", 1); //only accept cookies made by the server

session_set_cookie_params([
    'lifetime' => 1800,
    'domain' => 'localhost',
    'path' => '/',
    'secure'=> false , //for development only false cuz using xampp not https
    'httponly' => true 
]);

session_start();