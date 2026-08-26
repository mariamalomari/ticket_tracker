<?php

require_once "../models/User.php";

class LoginController {

    //error after post request(get request with error)
    public function showLoginPage($error) {
        if ($error == "loginFailed") {
            $message = 'Your email or password is incorrect.';
        } else {
            $message = null;
        }
        require_once '../views/login.php'; //this is to send the html to the browser, message variable will be in scope
    }


    //post request
    public function loginUser($email, $password) {

        $userModel = new User();
        if ($userModel->verifyCombination($email, $password)) {
            $userID = $userModel->getUserInfoByEmail($email)["id"];
            $_SESSION["user_id"] = $userID;
            header("Location: ../public/dashboard.php");
            exit();
        } else {
            header("Location: ../public/login.php?error=loginFailed");
            exit();
        }
    }
}