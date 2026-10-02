<?php
//so we can just require it in every page we need cookies in instead of rewriting

ini_set("session.use_only_cookies", 1); //use cookies for sessionid
ini_set("session.use_strict_mode", 1); //only accept cookies made by the server

session_set_cookie_params([
    'lifetime' => 1800,
    // 'domain' => 'localhost',
    'path' => '/',
    'secure'=> false , //for development only false cuz using xampp not https
    'httponly' => true,
    'samesite' => 'strict' //for same-origin protection
]);

session_start();


//making sure CSRF exists for every load
if (empty($_SESSION["csrf_token"])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

//to verify CSRF tokens
function verifyCSRFtoken($csrf_token) {
    if (!is_string($csrf_token)  || !is_string($_SESSION['csrf_token']) || empty($_SESSION['csrf_token'])) {
        return false;
    }
    if (hash_equals($_SESSION['csrf_token'], ($csrf_token))) {
        return true;
    }
    return false;
}

//authentication before accessing anything
// instead of manually writing it at the top of every public page
function requireAuth() {
    if (!isset($_SESSION["user_id"])) {
        header("Location: login.php");
        exit();
    }
}



function requireAdmin(): void {
    requireAuth();
    //if is_admin is false no permission
    if ($_SESSION['is_admin'] == false) {
        header("Location: ../public/projects.php?error=no_permission");
        exit();
    }
}